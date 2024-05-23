<?php

namespace App\Providers;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\ServiceProvider;
use Livewire\Component;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {
        Component::macro('toast', function ($message, $title = '', $type = 'success') {
            $this->dispatch('toast', message:$message, title: $title, type: $type);
        });
        VerifyCsrfToken::except(['webhook']);
    }
}
