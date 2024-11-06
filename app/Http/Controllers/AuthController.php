<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function registration()
    {
        if (Auth::check()) { // check if user is already logged in
            return redirect()->route('getPosts');
        }
        return view('signup');
    }

    public function registerUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email', // check if email already exists
            'password' => 'required|min:8',
        ], [
            'email.unique' => 'This email address is already registered.' // give an error if email exists, sent to the signup form
        ]);

        $user = new User(); // save new user information
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password =  Hash::make($request->password);
        $user->save();

        Auth::login($user); // Login User

        return redirect()->route('getPosts'); // Redirect user to landing page
    }

    public function authentication(Request $request) // login
    {
        if (Auth::check()) { // check if user is already logged in
            return redirect()->route('getPosts');
        }

        if ($request->filled('post_id')) {
            session(['post_id' => $request->post_id]);
        }

        return view('login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (session()->has('post_id')) {
                return redirect()->route('showPost', session('post_id'));
            }
            return redirect()->route('getPosts');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate and regenerate the session token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect the user to the login page or homepage
        return redirect('/home');
    }
}
