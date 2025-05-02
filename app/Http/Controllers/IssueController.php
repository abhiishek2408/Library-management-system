<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IssuedBook;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Notifications\BookIssuedNotification;
use Illuminate\Support\Facades\Notification;
use App\Models\User;

class IssueController extends Controller
{
    public function reserve($bookId)
    {
        $book = Book::findOrFail($bookId);
        $user = Auth::user();

        if ($book->quantity <= 0) {
            return redirect()->back()->with('error', 'This book is currently out of stock.');
        }

        $existing = IssuedBook::where('user_id', $user->id)
            ->where('book_id', $book->id)
            ->whereIn('status', ['reserved', 'pending', 'issued'])
            ->first();

        if ($existing) {
            return redirect()->back()->with('info', 'You already have a reservation or issue for this book.');
        }

        $activeReservations = IssuedBook::where('book_id', $book->id)
            ->whereIn('status', ['issued', 'reserved'])
            ->count();

        if ($activeReservations < $book->total_copies) {
            IssuedBook::create([
                'user_id' => $user->id,
                'book_id' => $book->id,
                'issue_date' => now(),
                'due_date' => now()->addDays(14),
                'status' => 'reserved',
                'reserved_at' => now(),
                'title' => $book->title,
                'author' => $book->author,
                'cost_of_issue' => $book->cost_of_issue,
                'penalty_per_day' => $book->penalty_per_day,
            ]);

            return redirect()->back()->with('success', 'Book reserved successfully.');
        }

        $reservation = IssuedBook::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'status' => 'pending',
            'reserved_at' => now(),
            'title' => $book->title,
            'author' => $book->author,
            'cost_of_issue' => $book->cost_of_issue,
            'penalty_per_day' => $book->penalty_per_day,
        ]);

        $this->notifyLibrarian($reservation);

        return redirect()->back()->with('success', 'All copies are issued. You are added to the waiting queue.');
    }





    protected function notifyLibrarian($reservation)
    {
        $librarians = User::whereHas('roles', function ($query) {
            $query->where('name', 'librarian');
        })->get();

        Notification::send($librarians, new BookIssuedNotification($reservation));
    }

    // Removed viewPendingReservations() completely

    public function manageBooks()
    {
        $books = Book::all();
        return view('dashboard.librarian', compact('books'));
    }

    public function issueBook($reservationId)
    {
        $reservation = IssuedBook::findOrFail($reservationId);

        if (Auth::check()) {
            $reservation->status = 'issued';
            $reservation->issued_by = Auth::id();
            $reservation->librarian_id = Auth::id();
            $reservation->issue_date = now();
            $reservation->due_date = now()->addDays(14);
            $reservation->save();

            return redirect()->route('dashboard.librarian')->with('success', 'Book has been issued.');
        } else {
            return redirect()->route('login')->with('error', 'You must be logged in to issue a book.');
        }
    }

    public function cancelReservation($id)
    {
        $issue = IssuedBook::findOrFail($id);

        if ($issue->user_id != Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $book = $issue->book;
        $wasReserved = $issue->status === 'reserved';

        $issue->delete();

        if ($wasReserved) {
            $nextInQueue = IssuedBook::where('book_id', $book->id)
                ->where('status', 'pending')
                ->orderBy('reserved_at')
                ->first();

            if ($nextInQueue) {
                $nextInQueue->status = 'reserved';
                $nextInQueue->issue_date = now();
                $nextInQueue->due_date = now()->addDays(14);
                $nextInQueue->save();
            }
        }

        return redirect()->back()->with('success', 'Reservation cancelled successfully.');
    }
}
