<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Inventory Registry</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Geist:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        @prodvite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-[#FDFBF9] text-[#111111] font-[Geist] antialiased min-h-screen flex flex-col items-center justify-center selection:bg-black selection:text-white">
        <div class="max-w-2xl w-full px-6 text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-black text-white mb-8 shadow-xl">
                <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256">
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" d="M223.68,66.15,135.68,18a15.88,15.88,0,0,0-15.36,0l-88,48.17a16,16,0,0,0-8.32,14v95.64a16,16,0,0,0,8.32,14l88,48.17a15.88,15.88,0,0,0,15.36,0l88-48.17a16,16,0,0,0,8.32-14V80.18A16,16,0,0,0,223.68,66.15ZM128,32,204.44,73.75l-71.57,39.26L51.56,73.75ZM40,90l80,42.83v89L40,178.61Zm176,88.58-80,43.21V132.86l80-43.87Z"/>
                </svg>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold tracking-tight mb-4 text-black">Inventory Registry</h1>
            <p class="text-lg text-black/60 mb-10 max-w-lg mx-auto leading-relaxed">
                A high-performance command center for managing assets, tracking inventory, and ensuring system integrity.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="w-full sm:w-auto px-8 py-3.5 bg-black text-white font-medium rounded-full hover:bg-black/80 transition-colors focus:ring-4 focus:ring-black/10">
                        Open Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="w-full sm:w-auto px-8 py-3.5 bg-black text-white font-medium rounded-full hover:bg-black/80 transition-colors focus:ring-4 focus:ring-black/10">
                        System Login
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-3.5 bg-white text-black border border-black/10 font-medium rounded-full hover:bg-black/5 transition-colors focus:ring-4 focus:ring-black/10">
                            Register Node
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </body>
</html>
