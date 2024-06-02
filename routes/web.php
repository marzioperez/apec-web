<?php

use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['guest']], function () {
    Route::get('/sign-up', \App\Livewire\Auth\SignUp::class)->name('sign-up');
    Route::get('/sign-in', \App\Livewire\Auth\SignIn::class)->name('login');
    Route::get('/reset-password', \App\Livewire\Auth\ResetPassword::class)->name('reset-password');
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('/flight-and-hotel', \App\Livewire\User\Flight\Index::class)->name('hotel');
    Route::get('/my-qr', \App\Livewire\User\Qr::class)->name('qr');

    Route::get('/progress', \App\Livewire\User\Progress\Index::class)->name('progress');
    Route::get('/guest-progress', \App\Livewire\User\Progress\Guest::class)->name('guest-progress');
    Route::get('/payment/{token}', \App\Livewire\User\Order\Index::class)->name('payment');
});

Route::get('/post/{slug}', \App\Livewire\CMS\Post::class)->name('post');
Route::get('/news', \App\Livewire\CMS\Blog::class)->name('news');
Route::get('/faq', \App\Livewire\CMS\FAQ::class)->name('faq');

Route::get('/{slug?}', \App\Livewire\CMS\Page::class)->name('page');

Route::post('webhook', \App\Actions\Webhook::class)->name('webhook');
