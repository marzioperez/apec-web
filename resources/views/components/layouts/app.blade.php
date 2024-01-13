<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{config('app.name')}}</title>
        @vite('resources/css/app.css')
        @livewireStyles
    </head>
    <body>
        <main>
            {{ $slot }}
        </main>
        <x-modal name="register-modal">
            <x-slot:body>
                <livewire:auth.register/>
            </x-slot>
        </x-modal>
        @livewireScripts
        @vite('resources/js/app.js')
        @stack('scripts')
    </body>
</html>
