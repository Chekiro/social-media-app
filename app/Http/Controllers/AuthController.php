<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function register(): View
    {
        return view('auth.register');
    }

    public function store()
    {
        $validated = request()->validate([
            'name' => 'required|min:4|max:40|unique:users',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:4'
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);

        Mail::to($user->email)->send(new WelcomeEmail($user));

        return redirect()->route('login')->with('success', "Account created Successfully!");
    }

    public function login(): View
    {
        return view('auth.login');
    }

    public function logout()
    {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('dashboard')->with('success', "Logout Successfully!");
    }

    public function authenticate()
    {
        $validated = request()->validate([
            'email' => 'required|email',
            'password' => 'required|min:4'
        ]);

        if (auth()->attempt($validated)) {
            request()->session()->regenerate();

            return redirect()->route('dashboard')->with('success', "Login Successfully!");
        }
        return redirect()->route('login')->withErrors([
            'email' => 'No matching users found with the provided email and password'
        ]);
    }


}
