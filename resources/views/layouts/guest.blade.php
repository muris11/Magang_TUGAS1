<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Registry') }}</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Geist:wght@300;400;500;600;700&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        @prodvite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-[Geist] text-[#111111] antialiased bg-[#FDFBF9] selection:bg-black selection:text-white flex flex-col min-h-screen">
        <div class="flex-1 flex flex-col justify-center items-center px-4 sm:px-6 py-12">
            <a href="/" class="mb-10 flex flex-col items-center gap-4 transition-transform hover:scale-[0.98]">
                <div class="w-16 h-16 rounded-2xl bg-black text-white flex items-center justify-center shadow-lg">
                    <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" d="M223.68,66.15,135.68,18a15.88,15.88,0,0,0-15.36,0l-88,48.17a16,16,0,0,0-8.32,14v95.64a16,16,0,0,0,8.32,14l88,48.17a15.88,15.88,0,0,0,15.36,0l88-48.17a16,16,0,0,0,8.32-14V80.18A16,16,0,0,0,223.68,66.15ZM128,32,204.44,73.75l-71.57,39.26L51.56,73.75ZM40,90l80,42.83v89L40,178.61Zm176,88.58-80,43.21V132.86l80-43.87Z"/>
                    </svg>
                </div>
                <span class="font-bold tracking-tight text-xl">System Access</span>
            </a>
            <div class="w-full sm:max-w-md bg-white rounded-[2rem] shadow-sm border border-black/[0.03] p-8 sm:p-10">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
