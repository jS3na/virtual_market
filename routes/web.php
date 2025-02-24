<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $name = 'admin';

    $user = User::where('name', $name)->first();

    Auth::login($user);
});
