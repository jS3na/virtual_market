<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'The email is required.',
            'email.email' => 'The email has to be a valid email.',
            'password.required' => 'The password is required.'
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)->first();

        if (!$user) return redirect()->back()->withInput()->with([
            'invalid_login' => 'Incorrect Credentials.'
        ]);

        if (!password_verify($password, $user->password)) return redirect()->back()->withInput()->with([
            'invalid_login' => 'Incorrect Credentials.'
        ]);

        Auth::login($user);

        return redirect(route('dashboard'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('login'));
    }
}
