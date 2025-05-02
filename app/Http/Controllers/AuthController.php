<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Models\IssuedBook;

class AuthController extends Controller
{
    public function showSignup()
    {
        return view('auth.signup');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    
    public function signup(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = new User([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'user',
        ]);

        $user->save();

        return redirect('/login')->with('success', 'Signup successful!');
    }


    public function login(Request $request) {
        
    $credentials = $request->only('email', 'password');
    $remember = $request->has('remember');

    if (Auth::attempt($credentials, $remember)) {
        $user = Auth::user();

        if ($user->role == 'admin') {
            $books = Book::all();
            return view('dashboard.admin', compact('user', 'books'));
        } elseif ($user->role == 'librarian') {
            // लाइब्रेरियन के लिए issuedBooks भेजना जरूरी है
            $books = Book::all();
            $issuedBooks = IssuedBook::with('book', 'user')->get(); // Get issued books
            return view('dashboard.librarian', compact('user', 'books', 'issuedBooks')); // Send issuedBooks too
        } else {
            // Redirect to the UserController@dashboard
            return redirect()->route('dashboard.user');
        }
    }

    return redirect('/login')->with('error', 'Invalid credentials');
}



    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function showForgotForm()
    {
        return view('auth.forgot');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email'      => $request->email,
            'token'      => $token,
            'created_at' => now()
        ]);

        $resetLink = url('/reset-password?token=' . $token . '&email=' . urlencode($request->email));

        Mail::raw("Click to reset your password: $resetLink", function ($message) use ($request) {
            $message->to($request->email)->subject('Reset Password');
        });

        return back()->with('success', 'Reset link sent to your email!');
    }

    public function showResetForm(Request $request)
    {
        return view('auth.reset', ['token' => $request->token, 'email' => $request->email]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email'    => 'required|email|exists:users,email',
            'password' => 'required|confirmed|min:6',
            'token'    => 'required'
        ]);

        $check = DB::table('password_resets')->where([
            'email' => $request->email,
            'token' => $request->token
        ])->first();

        if (!$check) {
            return back()->with('error', 'Invalid token!');
        }

        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password)
        ]);

        DB::table('password_resets')->where(['email' => $request->email])->delete();

        return redirect('/login')->with('success', 'Password reset successfully!');
    }
}
