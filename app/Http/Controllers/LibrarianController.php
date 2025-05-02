<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\IssuedBook;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use App\Http\Controllers\Category;


class LibrarianController extends Controller
{


    public function trackAvailableCopies(Request $request)
    {
        $user = Auth::user();

        // Check if the user is a librarian
        if ($user->role !== 'librarian') {
            return redirect('/login')->with('error', 'Unauthorized access!');
        }

        // Handle search functionality
        $search = $request->input('search');
        $books = Book::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%$search%")
                ->orWhere('author', 'like', "%$search%")
                ->orWhere('category', 'like', "%$search%")
                ->orWhere('isbn', 'like', "%$search%")
                ->orWhere('quantity', 'like', "%$search%");
        })->get();

        // Return the view with the necessary data
        return view('librarian.track-available-copies', compact('user', 'books'));
    }


    public function pendingRequests()
    {
        $user = Auth::user();

        // Check if the user is a librarian
        if ($user->role !== 'librarian') {
            return redirect('/login')->with('error', 'Unauthorized access!');
        }

        // Fetch all issued books with 'pending' status
        $issuedBooks = IssuedBook::with(['book', 'user'])
            ->where('status', 'reserved')
            ->get();

        return view('librarian.pending-requests', compact('user', 'issuedBooks'));
    }


    public function approve($id)
    {
        $issuedBook = IssuedBook::findOrFail($id);
        $pickupHours = 12; 
        $issuedBook->status = 'reserved';
        $issuedBook->pickup_timing = $pickupHours;
        $issuedBook->pickup_deadline = now()->addHours($pickupHours);
        $issuedBook->issue_date = now();
        $issuedBook->due_date = now()->addDays(); // 24 hours
        $issuedBook->return_date = now()->addDay(); // same as due_date
        $issuedBook->issued_by = Auth::id(); // current logged-in librarian ID
        $issuedBook->save();

        return back()->with('success', 'Book marked as reserved, we are waiting for pickup within 12hr otherwise it will be cancel automatically');
    }



    public function reject($id)
    {
        $issuedBook = IssuedBook::findOrFail($id);
        $issuedBook->status = 'rejected';
        $issuedBook->save();

        return back()->with('success', 'Reservation rejected.');
    }



    // public function addNewBook()
    // {
    //     return view('librarian.add_new_book');
    // }

    public function updatedBookRecord()
    {
        return view('librarian.updated_book_record');
    }

    // public function deleteBook()
    // {
    //     return view('librarian.delete_book');
    // }


    public function addNewBook(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'title' => 'required|string|max:255',
                'author' => 'required|string|max:255',
                'isbn' => 'required|string|max:100|unique:books,isbn',
                'publisher' => 'nullable|string|max:255',
                'edition' => 'nullable|string|max:100',
                'cost_of_issue' => 'required|numeric|min:0',
                'penalty_per_day' => 'required|numeric|min:0',
                'category' => 'required|string|max:100',
                'quantity' => 'required|integer|min:1',
                'status' => 'required|string|max:50',
                'availability' => 'required|string|max:50',
            ]);
    
            Book::create([
                'title' => $request->title,
                'author' => $request->author,
                'isbn' => $request->isbn,
                'publisher' => $request->publisher,
                'edition' => $request->edition,
                'cost_of_issue' => $request->cost_of_issue,
                'penalty_per_day' => $request->penalty_per_day,
                'category' => $request->category,
                'quantity' => $request->quantity,
                'status' => $request->status,
                'availability' => $request->availability,
            ]);
    
            return redirect()->back()->with('success', 'Book added successfully!');
        }
    
        return view('librarian.add_new_book');
    }
    

    public function deleteBook(Request $request)
{
    $user = Auth::user();

    if ($user->role !== 'librarian') {
        return redirect('/login')->with('error', 'Unauthorized access!');
    }

    // Search functionality
    $search = $request->input('search');

    $books = Book::when($search, function ($query, $search) {
        return $query->where('title', 'like', "%$search%")
            ->orWhere('author', 'like', "%$search%")
            ->orWhere('category', 'like', "%$search%")
            ->orWhere('isbn', 'like', "%$search%");
    })->get();

    return view('librarian.delete_book', compact('user', 'books', 'search'));
}


public function destroyBook($id)
{
    // Find the book by ID and delete it
    $book = Book::findOrFail($id);
    $book->delete();

    return back()->with('success', 'Book deleted successfully!');
}



// In LibrarianController.php

// Show the list of books for updating
public function updateBookRecord(Request $request)
{
    $user = Auth::user();

    // Check if the user is a librarian
    if ($user->role !== 'librarian') {
        return redirect('/login')->with('error', 'Unauthorized access!');
    }

    // Handle search functionality
    $search = $request->input('search');
    $books = Book::when($search, function ($query, $search) {
        return $query->where('title', 'like', "%$search%")
            ->orWhere('author', 'like', "%$search%")
            ->orWhere('category', 'like', "%$search%")
            ->orWhere('isbn', 'like', "%$search%")
            ->orWhere('quantity', 'like', "%$search%");
    })->get();

    return view('librarian.updated_book_record', compact('user', 'books'));
}

// Show the form for editing a book
public function editBook($id)
{
    $book = Book::findOrFail($id);
    return view('librarian.edit_book', compact('book'));
}

// Update the book record
public function updateBook(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'isbn' => 'required|string|max:255',
        'publisher' => 'required|string|max:255',
        'edition' => 'required|string|max:255',
        'cost_of_issue' => 'required|numeric',
        'penalty_per_day' => 'required|numeric',
        'category' => 'required|string|max:255',
        'quantity' => 'required|integer',
        'status' => 'required|string|max:255',
        'availability' => 'required|boolean',
    ]);

    $book = Book::findOrFail($id);
    $book->title = $request->title;
    $book->author = $request->author;
    $book->isbn = $request->isbn;
    $book->publisher = $request->publisher;
    $book->edition = $request->edition;
    $book->cost_of_issue = $request->cost_of_issue;
    $book->penalty_per_day = $request->penalty_per_day;
    $book->category = $request->category;
    $book->quantity = $request->quantity;
    $book->status = $request->status;
    $book->availability = $request->availability;
    $book->save();

    return redirect()->route('librarian.updated.book.record')->with('success', 'Book details updated successfully.');
}



public function manageCategoriesGenres(Request $request)
{
    // Fetch books with optional category and genre filters
    $categories = Book::distinct()->pluck('category');
    $genres = Book::distinct()->pluck('genre');

    $books = Book::when($request->category, function ($query, $category) {
            return $query->where('category', $category);
        })
        ->when($request->genre, function ($query, $genre) {
            return $query->where('genre', $genre);
        })
        ->get();

    return view('librarian.manage-categories-genres', compact('books', 'categories', 'genres'));
}



public function manageDamagedMissingBooks(Request $request)
{
    // Fetch books with optional filter for availability (available/damaged/missing)
    $availabilityFilter = $request->input('availability');
    $availabilities = ['available', 'damaged', 'missing'];

    $books = Book::when($availabilityFilter, function ($query, $availability) use ($availabilities) {
        if (in_array($availability, $availabilities)) {
            return $query->where('availability', $availability);
        }
    })->get();

    return view('librarian.manage-damaged-missing-books', compact('books'));
}


public function updateAvailability(Request $request, $id)
{
    $book = Book::findOrFail($id);
    $book->availability = $request->input('availability');
    $book->save();

    return back()->with('success', 'Book availability status updated successfully.');
}


public function reorderNewCopies(Request $request)
{
    $user = Auth::user();

    // Check if the user is a librarian
    if ($user->role !== 'librarian') {
        return redirect('/login')->with('error', 'Unauthorized access!');
    }

    // Handle search functionality
    $search = $request->input('search');
    $lowStockBooks = Book::when($search, function ($query, $search) {
        return $query->where('title', 'like', "%$search%")
                     ->orWhere('author', 'like', "%$search%")
                     ->orWhere('isbn', 'like', "%$search%");
    })
    ->where('quantity', '<', 5) // Set a threshold for low stock (less than 5 copies)
    ->get();

    // Return the view with the necessary data
    return view('librarian.reorder-new-copies', compact('user', 'lowStockBooks'));
}


public function reorderBook($id)
{
    $user = Auth::user();

    // Check if the user is a librarian
    if ($user->role !== 'librarian') {
        return redirect('/login')->with('error', 'Unauthorized access!');
    }

    // Find the book
    $book = Book::findOrFail($id);

    // Update the quantity (you can adjust the quantity or reorder as needed)
    $book->quantity += 10; // Adding 10 copies, you can modify this based on your requirement
    $book->save();

    return back()->with('success', 'New copies reordered successfully.');
}





public function returnBook($id)
{
    $user = Auth::user();

    // Check if the user is a librarian
    if ($user->role !== 'librarian') {
        return redirect('/login')->with('error', 'Unauthorized access!');
    }

    // Find the issued book
    $issuedBook = IssuedBook::findOrFail($id);

    // Update the status to 'returned'
    $issuedBook->status = 'returned';
    $issuedBook->save();

    return back()->with('success', 'Book returned successfully.');
}



// public function showIssueBookForm()
// {
//     $user = Auth::user();

//     if ($user->role !== 'librarian') {
//         return redirect('/login')->with('error', 'Unauthorized access!');
//     }

//     $books = Book::where('availability', 'available')->get();
//     $users = User::where('role', 'user')->get();

//     return view('librarian.issue-book-form', compact('user', 'books', 'users'));
// }

// public function storeIssuedBook(Request $request)
// {
//     $user = Auth::user();

//     if ($user->role !== 'librarian') {
//         return redirect('/login')->with('error', 'Unauthorized access!');
//     }

//     $request->validate([
//         'user_id' => 'required|exists:users,id',
//         'book_id' => 'required|exists:books,id',
//         'issue_date' => 'required|date',
//         'due_date' => 'required|date|after_or_equal:issue_date',
//     ]);

//     $book = Book::findOrFail($request->book_id);

//     IssuedBook::create([
//         'user_id' => $request->user_id,
//         'book_id' => $book->id,
//         'issue_date' => $request->issue_date,
//         'due_date' => $request->due_date,
//         'status' => 'issued',
//         'reserved_at' => now(),
//         'issued_by' => $user->name,
//         'librarian_id' => $user->id,
//         'title' => $book->title,
//         'author' => $book->author,
//         'cost_of_issue' => $book->cost_of_issue,
//         'penalty_per_day' => $book->penalty_per_day,
//     ]);

//     $book->update(['availability' => 'issued']);

//     return redirect()->route('librarian.issued.books')->with('success', 'Book issued successfully!');
// }



// 1. Show all available books
public function manualIssueBooks(Request $request)
{
    $user = Auth::user();
    if ($user->role !== 'librarian') {
        return redirect('/login')->with('error', 'Unauthorized access!');
    }

    $search = $request->input('search');
    $books = Book::where('status', 'available')
                ->when($search, function ($query, $search) {
                    return $query->where('title', 'like', "%$search%")
                                 ->orWhere('author', 'like', "%$search%")
                                 ->orWhere('isbn', 'like', "%$search%");
                })
                ->get();

    return view('librarian.manual-issue-books', compact('user', 'books'));
}

// 2. Show Hero Form for issuing a particular book
public function showIssueBookForm($book_id)
{
    $user = Auth::user();
    if ($user->role !== 'librarian') {
        return redirect('/login')->with('error', 'Unauthorized access!');
    }

    $book = Book::findOrFail($book_id);

    return view('librarian.issue-book-form', compact('user', 'book'));
}


// 3. Handle Manual Book Issue
public function issueBookManually(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'book_id' => 'required|exists:books,id',
    ]);

    $book = Book::findOrFail($request->book_id);

      // Check if the book is out of stock
    if ($book->quantity <= 0) {
        return back()->with('error', 'This book is currently out of stock.');
    }

    // Insert into issued_books table
    IssuedBook::create([
        'user_id'        => $request->user_id,
        'book_id'        => $book->id,
        'title'          => $book->title,
        'author'         => $book->author,
        'issue_date'     => now(),
        'due_date'       => now()->addDays(14), // Example: 2 weeks loan period
        'status'         => 'issued',
        'cost_of_issue'  => $book->cost_of_issue,
        'penalty_per_day'=> $book->penalty_per_day,
        'issued_by'      => Auth::id(),
        'librarian_id'   => Auth::id(),
    ]);

    // Update book availability to unavailable
    $book->availability = 'unavailable';
    $book->save();

    $book->quantity -= 1;
    $book->save();

    return redirect()->route('librarian.manual.issue.books')->with('success', 'Book issued successfully!');
}




// Fetch all issued books with renewal status 'pending'
public function manageRenewals(Request $request)
{
    $user = Auth::user();
    if ($user->role !== 'librarian') {
        return redirect('/login')->with('error', 'Unauthorized access!');
    }

    $search = $request->input('search');
    $books = IssuedBook::where('renewal_status', 'pending')
                ->when($search, function ($query, $search) {
                    return $query->where('title', 'like', "%$search%")
                                 ->orWhere('author', 'like', "%$search%")
                                 ->orWhere('isbn', 'like', "%$search%");
                })
                ->get();

    return view('librarian.manage-renewals', compact('user', 'books'));
}

// Approve the renewal
public function approveRenewal($id)
{
    $issue = IssuedBook::findOrFail($id);

    // Extend the due date by 14 days
    $currentDueDate = \Carbon\Carbon::parse($issue->due_date);
    $newDueDate = $currentDueDate->addDays(14);

    // Update renewal status and due date
    $issue->due_date = $newDueDate;
    $issue->renewal_status = 'approved'; // Set renewal status to approved
    $issue->renewal += 1; // Increment renewal count
    $issue->save();

    return redirect()->route('librarian.manage.renewals')->with('success', 'Renewal approved. New due date: ' . $newDueDate->toDateString());
}

// Reject the renewal
public function rejectRenewal($id)
{
    $issue = IssuedBook::findOrFail($id);

    // Update renewal status to "rejected"
    $issue->renewal_status = 'rejected';
    $issue->save();

    return redirect()->route('librarian.manage.renewals')->with('error', 'Renewal request rejected.');
}





// Show all reserved books on Librarian dashboard
public function manageReservations(Request $request)
{
    $user = Auth::user();
    if ($user->role !== 'librarian') {
        return redirect('/login')->with('error', 'Unauthorized access!');
    }

    $search = $request->input('search');

    $reservations = IssuedBook::where('status', 'reserved')
                    ->when($search, function ($query, $search) {
                        return $query->where('title', 'like', "%$search%")
                                     ->orWhere('author', 'like', "%$search%")
                                     ->orWhereHas('user', function ($q) use ($search) {
                                         $q->where('name', 'like', "%$search%");
                                     });
                    })
                    ->get();

    return view('librarian.manage-reservations', compact('reservations'));
}

// Issue reservation of user on Librarian dashboard
public function approveReservation($id)
{
    $reservation = IssuedBook::findOrFail($id);

    // Set the book as reserved (NOT issued yet)
    $reservation->status = 'issued';
    $reservation->reserved_at = now(); // optional: track when it was reserved
    $reservation->renewal_status = 'none';
    $reservation->save();

    return redirect()->route('librarian.manage.reservations')->with('success', 'Reservation approved and book reserved.');
}


// Reject reservation of user on Librarian dashboard
public function rejectReservation($id)
{
    $reservation = IssuedBook::findOrFail($id);
    $reservation->status = 'cancelled';
    $reservation->save();

    return redirect()->route('librarian.manage.reservations')->with('error', 'Reservation rejected.');
}




}
