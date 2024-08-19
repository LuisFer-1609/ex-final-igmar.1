<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-vh-100 d-flex flex-column" style="background-color: rgb(241, 241, 241)">
    <x-navbar />
    <div class="container flex-grow-1 d-flex flex-column overflow-hidden">
        <main class="flex-grow-1 row flex-column">

            <!-- Page Content -->
            {{ $slot }}
        </main>
    </div>
</body>

</html>
