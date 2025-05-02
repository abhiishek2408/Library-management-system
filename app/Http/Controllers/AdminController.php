<?php

// app/Http/Controllers/AdminController.php
// app/Http/Controllers/AdminController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{


    // Display the list of users
    public function index()
    {
        $users = User::all();  // Retrieve all users from the database
        return view('admin.users', compact('users'));
    }

    // Show the form to edit a user
    public function edit($id)
    {
        $user = User::findOrFail($id);  // Find the user by their ID
        return view('admin.edit', compact('user'));
    }

    // Update the user details
    public function update(Request $request, $id)
    {
        // Validation logic can go here
        $user = User::findOrFail($id);  // Retrieve the user to update

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            // Add other fields as needed
        ]);

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }



    public function create()
    {
        return view('admin.create_user');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,user',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->email_verified_at = now();
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->remember_token = Str::random(60);
        $user->save();

        return redirect()->route('admin.create.user')->with('success', 'User created successfully');
    }




  
    
    public function createLibrarian()
    {
        return view('admin.add-librarian');
    }
    
    public function storeLibrarian(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:librarian', // Ensure role is 'librarian'
        ]);
    
        // Create a new librarian
        $librarian = new User();
        $librarian->name = $request->input('name');
        $librarian->email = $request->input('email');
        $librarian->email_verified_at = now();
        $librarian->password = Hash::make($request->input('password'));
        $librarian->role = 'librarian'; // Fixed role as 'librarian'
        $librarian->remember_token = Str::random(60);
        $librarian->save();
    
        return redirect()->route('admin.librarians')->with('success', 'Librarian added successfully.');
    }



    public function manageLibrarians()
{
    $librarians = User::where('role', 'librarian')->get();
    return view('admin.delete-edit-librarian', compact('librarians'));
}

public function editLibrarian($id)
{
    $librarian = User::findOrFail($id);
    return view('admin.edit-librarian', compact('librarian'));
}

public function deleteLibrarian($id)
{
    $librarian = User::findOrFail($id);
    $librarian->delete();
    return redirect()->route('admin.delete-edit-librarian')->with('success', 'Librarian deleted successfully.');
}
    
    
}
