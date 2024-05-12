<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['guest']], function () {
    Route::get('/sign-up', \App\Livewire\Auth\SignUp::class)->name('sign-up');
    Route::get('/sign-in', \App\Livewire\Auth\SignIn::class)->name('login');
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('/progress', \App\Livewire\User\Progress\Index::class)->name('progress');
});
