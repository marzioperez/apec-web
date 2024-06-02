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
        <link rel="shortcut icon" href="{{asset('img/favicon.png')}}" type="image/x-icon">
        @vite('resources/css/app.css')
        @livewireStyles
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-4E60KDN9CL"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'G-4E60KDN9CL');
        </script>
    </head>
    <body class="antialiased {{($class ?? '')}}">
        <div class="min-h-screen flex flex-col">
            <livewire:common.header />
            <livewire:common.menu-mobile />
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
