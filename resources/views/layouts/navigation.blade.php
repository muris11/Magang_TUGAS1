<nav class="w-72 bg-white/40 backdrop-blur-xl border-r border-black/5 h-screen flex flex-col justify-between shrink-0 sticky top-0 hidden md:flex">
    <div class="px-8 py-10">
        <div class="flex items-center gap-4 mb-12">
            <div class="w-10 h-10 rounded-xl bg-black text-white flex items-center justify-center shadow-lg">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256">
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" d="M223.68,66.15,135.68,18a15.88,15.88,0,0,0-15.36,0l-88,48.17a16,16,0,0,0-8.32,14v95.64a16,16,0,0,0,8.32,14l88,48.17a15.88,15.88,0,0,0,15.36,0l88-48.17a16,16,0,0,0,8.32-14V80.18A16,16,0,0,0,223.68,66.15ZM128,32,204.44,73.75l-71.57,39.26L51.56,73.75ZM40,90l80,42.83v89L40,178.61Zm176,88.58-80,43.21V132.86l80-43.87Z"/>
                </svg>
            </div>
            <span class="font-bold tracking-tight text-2xl font-[Geist]">Registry</span>
        </div>
        <div class="flex flex-col gap-1.5">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-xl transition-colors {{ request()->routeIs('dashboard') ? 'bg-black text-white shadow-md' : 'text-black/60 hover:bg-black/5 hover:text-black' }}">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256"><rect x="32" y="48" width="192" height="160" rx="8" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="32" y1="96" x2="224" y2="96" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="96" y1="96" x2="96" y2="208" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
                <span class="font-medium text-[15px]">Dashboard</span>
            </a>
            <a href="{{ route('barang.index') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-xl transition-colors {{ request()->routeIs('barang.index') ? 'bg-black text-white shadow-md' : 'text-black/60 hover:bg-black/5 hover:text-black' }}">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" d="M223.68,66.15,135.68,18a15.88,15.88,0,0,0-15.36,0l-88,48.17a16,16,0,0,0-8.32,14v95.64a16,16,0,0,0,8.32,14l88,48.17a15.88,15.88,0,0,0,15.36,0l88-48.17a16,16,0,0,0,8.32-14V80.18A16,16,0,0,0,223.68,66.15ZM128,32,204.44,73.75l-71.57,39.26L51.56,73.75ZM40,90l80,42.83v89L40,178.61Zm176,88.58-80,43.21V132.86l80-43.87Z"/></svg>
                <span class="font-medium text-[15px]">Inventory</span>
            </a>
        </div>
    </div>
    <div class="px-8 py-6 border-t border-black/5 flex flex-col gap-4">
        <div class="flex items-center gap-3 px-4 py-2">
            <div class="w-8 h-8 rounded-full bg-black/5 flex items-center justify-center text-black/40">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" d="M117.25,157.92a60,60,0,1,0-66.5,0A95.83,95.83,0,0,0,3.53,228.8a8,8,0,0,0,8.87,8.85,122.28,122.28,0,0,1,143.2,0,8,8,0,0,0,8.87-8.85A95.83,95.83,0,0,0,117.25,157.92ZM172,120a52,52,0,1,1,52-52A52.06,52.06,0,0,1,172,120Zm69.34,92.51a87.61,87.61,0,0,0-43.2-46.7,76,76,0,0,1,15,4.95,106.39,106.39,0,0,1,41,31.78,8,8,0,0,1-12.83,10Z"/></svg>
            </div>
            <div class="flex flex-col">
                <span class="text-sm font-semibold tracking-tight">{{ Auth::user()->name }}</span>
                <span class="text-[11px] text-black/40">{{ Auth::user()->email }}</span>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="flex items-center justify-center gap-2 w-full px-4 py-2.5 rounded-xl transition-colors bg-black/5 text-black hover:bg-red-50 hover:text-red-600">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" d="M174,108a60,60,0,1,0,0,40"/><line x1="224" y1="128" x2="104" y2="128" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><polyline fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" points="192 96 224 128 192 160"/></svg>
                <span class="font-medium text-sm">System Logout</span>
            </a>
        </form>
    </div>
</nav>

<!-- Mobile Nav -->
<div class="md:hidden fixed bottom-0 left-0 w-full bg-white/80 backdrop-blur-lg border-t border-black/5 z-50 px-6 py-4 flex justify-between items-center">
    <a href="{{ route('dashboard') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('dashboard') ? 'text-black' : 'text-black/40' }}">
        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256"><rect x="32" y="48" width="192" height="160" rx="8" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="32" y1="96" x2="224" y2="96" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="96" y1="96" x2="96" y2="208" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
    </a>
    <a href="{{ route('barang.index') }}" class="flex flex-col items-center gap-1 {{ request()->routeIs('barang.index') ? 'text-black' : 'text-black/40' }}">
        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" d="M223.68,66.15,135.68,18a15.88,15.88,0,0,0-15.36,0l-88,48.17a16,16,0,0,0-8.32,14v95.64a16,16,0,0,0,8.32,14l88,48.17a15.88,15.88,0,0,0,15.36,0l88-48.17a16,16,0,0,0,8.32-14V80.18A16,16,0,0,0,223.68,66.15ZM128,32,204.44,73.75l-71.57,39.26L51.56,73.75ZM40,90l80,42.83v89L40,178.61Zm176,88.58-80,43.21V132.86l80-43.87Z"/></svg>
    </a>
    <form method="POST" action="{{ route('logout') }}" class="m-0 p-0">
        @csrf
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="flex flex-col items-center gap-1 text-red-500/60 hover:text-red-600">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" d="M174,108a60,60,0,1,0,0,40"/><line x1="224" y1="128" x2="104" y2="128" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><polyline fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" points="192 96 224 128 192 160"/></svg>
        </a>
    </form>
</div>
