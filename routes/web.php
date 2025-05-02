<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LibrarianController;
use App\Http\Controllers\AdminController;

// Authentication Routes
Route::get('/signup', [AuthController::class, 'showSignup']);
Route::post('/signup', [AuthController::class, 'signup']);
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/forgot-password', [AuthController::class, 'showForgotForm']);
Route::post('/forgot-password', [AuthController::class, 'sendResetLink']);
Route::get('/reset-password', [AuthController::class, 'showResetForm']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

// Shared Routes for Book Search
Route::get('/books', [BookController::class, 'index']);

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
// USER Routes
Route::get('/dashboard/user', [UserController::class, 'dashboard'])->name('dashboard.user');
Route::post('/renew/{id}', [UserController::class, 'renewBook'])->name('user.renew');
Route::post('/cancel/{id}', [UserController::class, 'cancelReservation'])->name('user.cancelReservation');


// Librarian Routes for Book CRUD
Route::prefix('librarian')->group(function () {
    Route::get('/books', [BookController::class, 'index']);
    Route::get('/books/create', [BookController::class, 'create']);
    Route::post('/books', [BookController::class, 'store']);
    Route::get('/books/{book}/edit', [BookController::class, 'edit']);
    Route::put('/books/{book}', [BookController::class, 'update']);
    Route::delete('/books/{book}', [BookController::class, 'destroy']);

    // Route::get('/dashboard', [LibrarianController::class, 'dashboard'])->name('dashboard.librarian');
});

Route::get('/track-available-copies', [LibrarianController::class, 'trackAvailableCopies'])->name('track.available.copies');
Route::get('/track-available-copies', [LibrarianController::class, 'trackAvailableCopies'])->name('track.available.copies');




// Admin Routes



// Additional routes for user and librarian dashboards
Route::get('/librarian/book/create', [BookController::class, 'create'])->name('librarian.book.create');
Route::post('/librarian/book/store', [BookController::class, 'store'])->name('librarian.book.store');
Route::get('/librarian/book/edit/{id}', [BookController::class, 'edit'])->name('librarian.book.edit');
Route::post('/librarian/book/update/{id}', [BookController::class, 'update'])->name('librarian.book.update');
Route::post('/librarian/book/delete/{id}', [BookController::class, 'destroy'])->name('librarian.book.delete');
Route::post('/librarian/issue/{id}', [IssueController::class, 'issueBook'])->name('librarian.issue');
Route::post('/librarian/accept-return/{id}', [IssueController::class, 'acceptReturn'])->name('librarian.acceptReturn');

// Routes for book reservation, renewal, and cancellation
Route::post('/user/reserve/{id}', [IssueController::class, 'reserve'])->name('user.reserve');
// Route::post('/user/cancel-reservation/{id}', [IssueController::class, 'cancelReservation'])->name('user.cancelReservation');
Route::post('/user/renew/{id}', [IssueController::class, 'renew'])->name('user.renew');


Route::post('/cancel-reservation/{id}', [IssueController::class, 'cancelReservation'])->name('cancel.reservation');


// Route::get('librarian/issue-book/{issueId}', [IssueController::class, 'issueBook'])->name('librarian.issueBook');

// Route::get('/librarian/dashboard', [LibrarianController::class, 'dashboard'])->name('dashboard.librarian');
// Route::post('/librarian/approve/{id}', [LibrarianController::class, 'approve'])->name('librarian.approve');
// Route::post('/librarian/reject/{id}', [LibrarianController::class, 'reject'])->name('librarian.reject');



// Add new book route (GET to show form, POST to store book)



Route::middleware(['auth'])->group(function () {



    Route::get('/pending-requests', [LibrarianController::class, 'pendingRequests'])->name('librarian.pending.requests');

    // Routes for the new book pages (just blank pages for now)
    // Route::get('/add-new-book', [LibrarianController::class, 'addNewBook'])->name('librarian.add.new.book');

    // Librarian add new book
    Route::match(['get', 'post'], '/librarian/add-new-book', [LibrarianController::class, 'addNewBook'])->name('librarian.addNewBook');

    Route::get('/updated-book-record', [LibrarianController::class, 'updatedBookRecord'])->name('librarian.updated.book.record');
    // Route::get('/delete-book', [LibrarianController::class, 'deleteBook'])->name('librarian.delete.book');

    // Route::delete('/librarian/delete-book/{id}', [LibrarianController::class, 'deleteBookById'])->name('librarian.book.delete');


    Route::post('/approve/{id}', [LibrarianController::class, 'approve'])->name('librarian.approve');
    Route::post('/reject/{id}', [LibrarianController::class, 'reject'])->name('librarian.reject');
});


Route::middleware(['auth'])->prefix('librarian')->group(function () {
    Route::get('/delete-book', [LibrarianController::class, 'deleteBook'])->name('librarian.delete.book');
    // You can add a POST route for the deletion action
    Route::delete('/delete-book/{id}', [LibrarianController::class, 'destroyBook'])->name('librarian.delete.book.action');
});
// routes/web.php

// Routes for updating book record
// In routes/web.php
Route::middleware(['auth'])->prefix('librarian')->group(function () {
    Route::get('/update-book-record', [LibrarianController::class, 'updateBookRecord'])->name('librarian.updated.book.record');
    Route::get('/edit-book/{id}', [LibrarianController::class, 'editBook'])->name('librarian.edit.book');
    Route::post('/update-book/{id}', [LibrarianController::class, 'updateBook'])->name('librarian.update.book');
});


// web.php
// Routes for managing categories and genres
Route::get('/librarian/manage-categories-genres', [LibrarianController::class, 'manageCategoriesGenres'])->name('librarian.manage.categories.genres');


Route::get('librarian/manage-damaged-missing-books', [LibrarianController::class, 'manageDamagedMissingBooks'])->name('librarian.manage.damaged.missing');
Route::put('librarian/update-availability/{id}', [LibrarianController::class, 'updateAvailability'])->name('librarian.update.availability');

Route::get('librarian/reorder-new-copies', [LibrarianController::class, 'reorderNewCopies'])->name('librarian.reorder.new.copies');

Route::post('librarian/reorder-book/{id}', [LibrarianController::class, 'reorderBook'])->name('librarian.reorder.book');

Route::get('librarian/issued-books', [LibrarianController::class, 'issuedBooks'])->name('librarian.return.books');

Route::post('librarian/return-book/{id}', [LibrarianController::class, 'returnBook'])->name('librarian.return.book');


// Show manual issue book form
Route::get('librarian/issue-book-manually', [LibrarianController::class, 'showIssueBookForm'])->name('librarian.issue.book.manually');

// Handle form submit
Route::post('librarian/issue-book-manually', [LibrarianController::class, 'storeIssuedBook'])->name('librarian.store.issued.book.manually');



// Show Available Books to Issue
Route::get('librarian/manual-issue-books', [LibrarianController::class, 'manualIssueBooks'])->name('librarian.manual.issue.books');

// Show Hero Form to Issue Selected Book
Route::get('librarian/issue-book-form/{book_id}', [LibrarianController::class, 'showIssueBookForm'])->name('librarian.show.issue.book.form');

// Handle Form Submission
Route::post('librarian/issue-book', [LibrarianController::class, 'issueBookManually'])->name('librarian.issue.book.manually');



// Fetch all books with renewal status 'pending'
Route::get('librarian/manage-renewals', [LibrarianController::class, 'manageRenewals'])->name('librarian.manage.renewals');

// Approve Renewal
Route::get('librarian/approve-renewal/{id}', [LibrarianController::class, 'approveRenewal'])->name('librarian.approve.renewal');

// Reject Renewal
Route::get('librarian/reject-renewal/{id}', [LibrarianController::class, 'rejectRenewal'])->name('librarian.reject.renewal');


// Route::middleware('auth')->group(function () {
//     // Route for librarian to manage books and view pending reservations
//     Route::get('librarian/dashboard', [IssueController::class, 'manageBooks'])->name('dashboard.librarian');

//     // Route for librarian to issue a book
//     Route::post('librarian/issue-book/{reservationId}', [IssueController::class, 'issueBook'])->name('librarian.issueBook');
// });



// Issue Controller Routes (reserve, issue book, cancel reservation)
Route::post('reserve/{bookId}', [IssueController::class, 'reserve'])->name('reserve.book');
Route::post('issue/{reservationId}', [IssueController::class, 'issueBook'])->name('issue.book');
Route::delete('cancel/{reservationId}', [IssueController::class, 'cancelReservation'])->name('cancel.reservation');


// In routes/web.php





// recently added for nav lists

// User
Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('dashboard.user');
Route::get('/user/issued', [UserController::class, 'issued'])->name('user.issued');
Route::get('/user/reservations', [UserController::class, 'reservations'])->name('user.reservations');

// Librarian
Route::get('/librarian/dashboard', [LibrarianController::class, 'dashboard'])->name('dashboard.librarian');
Route::get('/librarian/books', [LibrarianController::class, 'books'])->name('librarian.books');
Route::get('/librarian/issued', [LibrarianController::class, 'issued'])->name('librarian.issued');

// Admin
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('dashboard.admin');
Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
Route::get('/admin/settings', [AdminController::class, 'settings'])->name('admin.settings');


// Manage Reservations
Route::get('librarian/manage-reservations', [LibrarianController::class, 'manageReservations'])->name('librarian.manage.reservations');

// Approve reservation
Route::post('/librarian/approve-reservation/{id}', [LibrarianController::class, 'approveReservation'])->name('librarian.approve.reservation');

// Reject reservation
Route::get('librarian/reject-reservation/{id}', [LibrarianController::class, 'rejectReservation'])->name('librarian.reject.reservation');



// Route::get('/books', [BookController::class, 'index'])->name('books.index');

Route::get('/books/available', [UserController::class, 'availableBooks'])->name('books.available');
Route::get('/issue-requests', [UserController::class, 'issueRequests'])->name('user.issueRequests');
Route::get('/reserved-requests', [UserController::class, 'reservedRequests'])->name('user.reserved_requests');
Route::get('/user/issued-books', [UserController::class, 'issuedBooks'])->name('user.issuedBooks');

Route::get('/user/account', [UserController::class, 'account'])->name('user.account');
Route::get('/user/fiction-books', [UserController::class, 'fictionBooks'])->name('user.fictionBooks');
Route::get('/user/nonfiction-books', [UserController::class, 'nonfictionBooks'])->name('user.nonfictionBooks');

Route::get('books', [UserController::class, 'listBooks'])->name('books.list');  // Show all books
Route::post('books/{book}/review', [UserController::class, 'addReview'])->name('user.add.review');  // Submit review




Route::get('admin/create-user', [AdminController::class, 'create'])->name('admin.create.user');
Route::post('admin/store-user', [AdminController::class, 'store'])->name('admin.store.user');




// Route to display all users in the admin dashboard
Route::get('admin/users', [AdminController::class, 'index'])->name('admin.users');

// Route to edit a user
Route::get('admin/user/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit.user');

// Route to update user data (in case you have an update functionality)
Route::put('admin/user/{id}', [AdminController::class, 'update'])->name('admin.update.user');

// Route to delete
Route::delete('admin/librarian/{id}', [AdminController::class, 'deleteLibrarian'])->name('admin.librarians.delete');



Route::get('/admin/librarians', [AdminController::class, 'showLibrarians'])->name('admin.librarians');

// Route::get('admin/librarians/create', [AdminController::class, 'createLibrarian'])->name('admin.librarians.create');
// // Route::post('admin/librarians', [AdminController::class, 'storeLibrarian'])->name('admin.librarians.store');

// // Route to add a librarian
// Route::get('/admin/librarians/add', [AdminController::class, 'createLibrarian'])->name('admin.librarian.add');

// Route to show the "Add Librarian" form
Route::get('/admin/librarians/create', [AdminController::class, 'createLibrarian'])->name('admin.create.librarian');

// Route to store the new librarian in the database
Route::post('/admin/librarians', [AdminController::class, 'storeLibrarian'])->name('admin.store.librarian');



Route::get('/admin/librarians/manage', [AdminController::class, 'manageLibrarians'])->name('admin.delete-edit-librarian');
Route::get('/admin/librarians/{id}/edit', [AdminController::class, 'editLibrarian'])->name('admin.edit-librarian');
Route::delete('/admin/librarians/{id}', [AdminController::class, 'deleteLibrarian'])->name('admin.delete-librarian');



Route::post('/books/{book}/reviews', [UserController::class, 'addReview'])->name('reviews.add');
