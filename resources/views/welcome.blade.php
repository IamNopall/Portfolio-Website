<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="High-end personal portfolio built with Laravel and Vue.">

        <title>{{ config('app.name', 'Portfolio') }}</title>

        <!-- Dynamic Favicon Icons -->
        <link rel="icon" type="image/png" href="/images/whitelogo.png" media="(prefers-color-scheme: dark)" />
        <link rel="icon" type="image/png" href="/images/blacklogo.png" media="(prefers-color-scheme: light)" />
        <link rel="icon" type="image/png" href="/images/whitelogo.png" />

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=outfit:400,500,600,700,800,900&display=swap" rel="stylesheet" />
        <link href="https://fonts.bunny.net/css?family=manrope:300,400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div id="app"></div>
    </body>
</html>
