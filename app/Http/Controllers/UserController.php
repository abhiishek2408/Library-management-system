<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Review;
use App\Models\IssuedBook;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{

    public function availableBooks(Request $request)
    {

        $user = Auth::user();

        
        $search = $request->input('search');

        
        $books = Book::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%$search%")
                ->orWhere('author', 'like', "%$search%")
                ->orWhere('category', 'like', "%$search%")
                ->orWhere('isbn', 'like', "%$search%")
                ->orWhere('publisher', 'like', "%$search%")
                ->orWhere('edition', 'like', "%$search%");
        })->get();

        return view('user.available_books', compact('user', 'books'));
    }



    public function issueRequests()
    {
        $user = Auth::user();

        $requests = IssuedBook::where('user_id', $user->id)
            ->where('status', 'pending')
            ->with('book')
            ->get();

        return view('user.issue_requests', compact('requests'));
    }


    public function reservedRequests()
    {
        $user = Auth::user();

        $reservedRequests = IssuedBook::where('user_id', $user->id)
            ->where('status', 'reserved')
            ->get();

        return view('user.reserved_requests', compact('reservedRequests'));
    }



    public function issuedBooks()
    {
        $user = Auth::user(); 

        
        $issuedBooks = IssuedBook::where('user_id', $user->id)
            ->where('status', 'issued')
            ->with('book')
            ->get();

        return view('user.issued_books', compact('issuedBooks'));
    }



    public function account()
    {
        $user = Auth::user();

        $issuedCount = IssuedBook::where('user_id', $user->id)->where('status', 'issued')->count();
        $reservedCount = IssuedBook::where('user_id', $user->id)->where('status', 'reserved')->count();
        $overdueCount = IssuedBook::where('user_id', $user->id)
            ->where('status', 'issued')
            ->whereDate('due_date', '<', now())
            ->count();

        $recentIssued = IssuedBook::with('book')
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        return view('user.account', compact('user', 'issuedCount', 'reservedCount', 'overdueCount', 'recentIssued'));
    }


    
    public function dashboard(Request $request)
    {
        $user = Auth::user();

        
        $search = $request->input('search');

        
        $books = Book::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%$search%")
                ->orWhere('author', 'like', "%$search%")
                ->orWhere('category', 'like', "%$search%")
                ->orWhere('isbn', 'like', "%$search%")
                ->orWhere('publisher', 'like', "%$search%")
                ->orWhere('edition', 'like', "%$search%");
        })->get();

        
        
        
        


        $issuedBooks = \App\Models\IssuedBook::where('user_id', $user->id)
            ->where('status', 'issued') 
            ->with('book')
            ->get();

        $pendingReservations = IssuedBook::where('user_id', $user->id)
            ->where('status', 'pending')
            ->with('book')
            ->get();

        return view('dashboard.user', compact('user', 'books', 'issuedBooks', 'pendingReservations',));
    }



    public function reserve($bookId)
    {

        $book = Book::findOrFail($bookId);

        if ($book->availability) {
            IssuedBook::create([
                'user_id' => Auth::id(),
                'book_id' => $book->id,
                'issue_date' => now(),
                'due_date' => now()->addDays(14), 
                'status' => 'reserved',
            ]);

            $book->availability = false;
            $book->save();
        }

        return redirect()->back()->with('success', 'Book reserved successfully.');
    }


    
    
    

    
    
    

    
    
    

    
    



    
    public function requestRenewal($id)
    {
        $issue = IssuedBook::findOrFail($id);

        
        if ($issue->renewal_status == 'approved' || $issue->renewal_status == 'rejected') {
            return redirect()->back()->with('error', 'Renewal already processed.');
        }

        
        if ($issue->renewal >= 2) {
            return redirect()->back()->with('error', 'Maximum renewals reached.');
        }

        
        $issue->renewal_status = 'pending';
        $issue->save();

        
        

        return redirect()->back()->with('success', 'Renewal request sent and is pending approval.');
    }




    public function cancelReservation($id)
    {
        $issue = IssuedBook::findOrFail($id);
        $book = $issue->book;

        $issue->delete();
        if ($book) {
            $book->availability = true;
            $book->save();
        }

        return redirect()->back()->with('success', 'Reservation cancelled.');
    }




    public function fictionBooks()
{
    $user = Auth::user();
    $fictionBooks = Book::where('category', 'Fictional')->get();

    return view('user.fiction', compact('fictionBooks'));
}

public function nonfictionBooks()
{
$user = Auth::user();
$nonfictionBooks = Book::where('category', 'Non-Fictional')->get();

return view('user.nonfiction', compact('nonfictionBooks'));
}





public function listBooks()
{
    $books = Book::all(); 
    return view('user.books', compact('books'));
}


// public function addReview(Request $request, $bookId)
// {
//     $request->validate([
//         'review' => 'required|integer|min:1|max:5',  
//     ]);

    
//     $book = Book::findOrFail($bookId);

    
//     $book->review = $request->input('review');
//     $book->save();

//     return redirect()->route('books.list')->with('success', 'Review submitted successfully!');
// }


public function addReview(Request $request, $bookId)
{
    // Validate the review input (rating must be between 1 and 5)
    $request->validate([
        'review' => 'required|integer|min:1|max:5', // Validate review between 1 and 5
    ]);

    // Find the book by ID
    $book = Book::findOrFail($bookId);

    // Check if the user has already reviewed this book
    $existingReview = Review::where('book_id', $bookId)
                            ->where('user_id', Auth::id()) // Assuming the user is logged in
                            ->first();

    if ($existingReview) {
        // If a review already exists, update it
        $existingReview->rating = $request->input('review');
        $existingReview->save();
    } else {
        // Otherwise, create a new review
        Review::create([
            'book_id' => $bookId,
            'user_id' => Auth::id(),  // Store the logged-in user's ID
            'rating' => $request->input('review'),
            'review_text' => $request->input('review_text', null), // Optional: review text if provided
            'title' => $book->title,  // ✅ Add the book title here
            'is_approved' => false, // You can later manually approve reviews if needed
            'visibility' => 'public', // Default visibility, can be modified later
        ]);
    }

    return redirect()->route('books.list')->with('success', 'Review submitted successfully!');
}






}
