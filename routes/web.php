<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/sign-up', \App\Livewire\Auth\SignUp::class)->name('sign-up');
Route::get('/sign-in', \App\Livewire\Auth\SignIn::class)->name('sign-in');
