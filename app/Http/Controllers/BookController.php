<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\IssuedBook;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller {

    // USER dashboard view
    public function index(Request $request) {
        
        $search = $request->input('search'); // Retrieve search query
    
        // Query to get books based on the search
        $books = Book::when($search, function ($query, $search) {
                return $query->where('title', 'like', "%$search%")
                             ->orWhere('author', 'like', "%$search%")
                             ->orWhere('category', 'like', "%$search%")
                             ->orWhere('isbn', 'like', "%$search%")
                             ->orWhere('publisher', 'like', "%$search%");
            })
            ->get(); // Fetch the books
    
        return view('books.index', compact('books')); // Pass books to view
    }


    

    // LIBRARIAN dashboard


    // public function librarianDashboard(Request $request)
    // {
    //     $search = $request->input('search'); // Get the search term
    
    //     // If search term exists, filter the books, otherwise get all books
    //     $books = Book::when($search, function ($query, $search) {
    //             return $query->where('title', 'like', "%$search%")
    //                          ->orWhere('author', 'like', "%$search%")
    //                          ->orWhere('category', 'like', "%$search%")
    //                          ->orWhere('isbn', 'like', "%$search%")
    //                          ->orWhere('publisher', 'like', "%$search%");
    //         })
    //         ->get();
    
    //     $issuedBooks = IssuedBook::with('book', 'user')->get();
    
    //     return view('librarian', compact('books', 'issuedBooks')); // Return the data to the view
    // }
    


    // Show create form
    public function create()
    {
        return view('books.create');
    }



    // Store a new book
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'required|string|max:255|unique:books',
            'publisher' => 'nullable|string|max:255',
            'edition' => 'nullable|string|max:255',
            'publication_year' => 'nullable|date_format:Y',
            'genre' => 'nullable|string|max:255',
            'language' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'total_copies' => 'required|integer|min:1',
            'available_copies' => 'required|integer|min:1',
            'shelf_location' => 'nullable|string|max:255',
            'cover_image' => 'nullable|image',
            'book_type' => 'required|in:Printed,Digital,Audio',
            'file_url' => 'nullable|url',
            'price' => 'nullable|numeric',
            'penalty' => 'nullable|numeric',
        ]);

        // Handle cover image upload if present
        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        Book::create($validated);

        return redirect()->back()->with('success', 'Book added successfully!');
    }

    // Show edit form
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('books.edit', compact('book'));
    }

    // Update the book
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'required|string|max:255|unique:books,isbn,' . $id,
            'publisher' => 'nullable|string|max:255',
            'edition' => 'nullable|string|max:255',
            'publication_year' => 'nullable|date_format:Y',
            'genre' => 'nullable|string|max:255',
            'language' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'total_copies' => 'required|integer|min:1',
            'available_copies' => 'required|integer|min:1',
            'shelf_location' => 'nullable|string|max:255',
            'cover_image' => 'nullable|image',
            'book_type' => 'required|in:Printed,Digital,Audio',
            'file_url' => 'nullable|url',
            'price' => 'nullable|numeric',
            'penalty' => 'nullable|numeric',
        ]);

        $book = Book::findOrFail($id);

        // Handle cover image upload if present
        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        $book->update($request->all());

        return redirect()->route('dashboard.librarian')->with('success', 'Book updated successfully.');
    }

    // Delete the book
    public function destroy($id)
    {
        Book::findOrFail($id)->delete();
        return redirect()->route('dashboard.librarian')->with('success', 'Book deleted.');
    }

    
}
