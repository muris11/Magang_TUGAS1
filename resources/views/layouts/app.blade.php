<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Inventory Registry | Command Center</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Geist:wght@300;400;500;600;700&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        @prodvite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-[#111111] bg-[#FDFBF9] selection:bg-black selection:text-white">
        <div class="min-h-screen flex">
            @include('layouts.navigation')
            <main class="flex-1 p-8 md:p-12 relative min-h-screen">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
