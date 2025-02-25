<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function page()
    {
        $users = User::all();

        return view('users.users', [
            'users' => $users
        ]);
    }

    public function addPage()
    {
        $roles = Role::all();
        return view('users.add', [
            'roles' => $roles
        ]);
    }

    public function addUser(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|unique:users,email',
        ], [
            'name.required' => 'The name is required.',
            'name.min' => 'The name must have at least :min characters.',
            'name.max' => 'The name must have at most :max characters.',
            'email.required' => 'The email is required.',
            'email.email' => 'The email has to be a valid email.',
            'email.unique' => 'This email already exists on our database.',
        ]);

        $name = $request->input('name');
        $email = $request->input('email');
        $password = $email;
        $role_id = $request->input('role_id');

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = bcrypt($password);
        $user->role_id = $role_id;
        $user->save();

        return redirect(route('users'));
    }

    public function editPage($user_id)
    {
        $roles = Role::all();
        $user = User::where('id', $user_id)->first();

        
        if(!$user) return redirect()->back();
        
        return view('users.edit', [
            'roles' => $roles,
            'user' => $user
        ]);
    }

    public function editUser(Request $request, $user_id)
    {
        $user = User::where('id', $user_id)->first();

        if(!$user) return redirect()->back();

        $role_id = $request->input('role_id');

        $user->role_id = $role_id;
        $user->save();

        return redirect(route('users'));
    }

    public function deleteUser($user_id)
    {
        if($user_id == 1 || $user_id == Auth::user()->id){
            return redirect(route('users'));
        }

        $user = User::where('id', $user_id)->first();
        if (!$user) return redirect()->back();

        $user->delete();
        return redirect(route('users'));
    }

    public function changePasswordPage()
    {
        return view('users.change_password');
    }

    public function changeUserPassword(Request $request)
    {

        $user = User::where('id', Auth::user()->id)->first();

        if(!$user) return redirect()->back();

        $request->validate([
            'actual_password' => 'required',
            'new_password' => 'required|min:5|max:32|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'new_password_confirmation' => 'required|same:new_password',
        ], [
            'actual_password.required' => 'The actual user password is required.',
            'new_password.required' => 'The new user password is required.',
            'new_password.min' => 'The new user password must have at least :min characters.',
            'new_password.max' => 'The new user password must have at most :max characters.',
            'new_password.regex' => 'The new user password must contain at least one lowercase letter, one uppercase letter, and one symbol.',
            'new_password_confirmation.same' => "The passwords don't match."
        ]);

        $actual_password = $request->input('actual_password');
        $new_password = $request->input('new_password');

        if (!password_verify($actual_password, $user->password)) return redirect()->back()->withInput()->with([
            'invalid_form' => 'Actual password is wrong.'
        ]);

        $user->password = bcrypt($new_password);
        $user->save();

        Auth::logout();

        return redirect(route('login'));
    }
}
