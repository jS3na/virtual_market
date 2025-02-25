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

        return redirect(route('home'));
    }

    public function registerPage(){
        return view('auth.register');
    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required|min:5|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|max:32|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'
        ],[
            'name.required' => 'The name is required.',
            'name.min' => 'The name must have at least :min characters.',
            'name.max' => 'The name must have at most :max characters.',
            'email.required' => 'The email is required.',
            'email.email' => 'The email has to be a valid email.',
            'email.unique' => 'This email already exists on our database.',
            'password.required' => 'The password is required',
            'password.min' => 'The password must have at least :min characters.',
            'password.max' => 'The password must have at most :max characters.',
            'password.regex' => 'The password must contain at least one lowercase letter, one uppercase letter, and one symbol.'
        ]);

        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = bcrypt($password);
        $user->save();

        Auth::login($user);
        return redirect(route('home'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('login'));
    }
}
