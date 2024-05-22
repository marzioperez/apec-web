<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{config('app.name')}}</title>

        <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/all.css">
        <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/sharp-solid.css">
        <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/sharp-regular.css">
        <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/sharp-light.css">

        @vite('resources/css/app.css')
        @livewireStyles

    </head>
    <body class="antialiased">
        <div class="min-h-screen flex flex-col">
            <livewire:common.header />
            <main>
                {{ $slot }}
            </main>
            <x-footer />
        </div>
        <x-toast />
        @livewireScripts
        @vite('resources/js/app.js')
        @stack('scripts')
    </body>
</html>
