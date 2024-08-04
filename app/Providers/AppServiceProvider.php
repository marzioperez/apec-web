<?php

namespace App\Providers;

use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Validator;
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
        FilamentAsset::register([
            Css::make('back', __DIR__.'/../../resources/css/back.css'),
            Js::make('back', __DIR__ . '/../../resources/js/dist/back.js'),
        ]);
        Validator::extend('max_uploaded_file_size', function ($attribute, $value, $parameters, $validator) {
            $total_size = array_reduce($value, function ( $sum, $item ) {
                // each item is UploadedFile Object
                $sum += filesize($item['path']);
                return $sum;
            });

            // $parameters[0] in kilobytes
            return $total_size < $parameters[0] * 1024;
        });
    }
}
