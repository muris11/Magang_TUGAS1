<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-6">
        @csrf
        <div>
            <label for="email" class="block text-sm font-medium text-black/70 mb-2">Email Address</label>
            <input id="email" class="block w-full rounded-xl border-black/10 focus:border-black focus:ring-black/5 bg-black/5 px-4 py-3 text-black transition-colors" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
        </div>
        <div>
            <div class="flex justify-between items-center mb-2">
                <label for="password" class="block text-sm font-medium text-black/70">Password</label>
                @if (Route::has('password.request'))
                    <a class="text-xs font-medium text-black/40 hover:text-black transition-colors" href="{{ route('password.request') }}">
                        Forgot password?
                    </a>
                @endif
            </div>
            <input id="password" class="block w-full rounded-xl border-black/10 focus:border-black focus:ring-black/5 bg-black/5 px-4 py-3 text-black transition-colors" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
        </div>
        <div class="block">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-black/20 text-black shadow-sm focus:ring-black/20" name="remember">
                <span class="ml-3 text-sm text-black/60 font-medium">Keep me logged in</span>
            </label>
        </div>
        <button type="submit" class="w-full bg-black text-white rounded-xl py-3.5 font-medium hover:bg-black/80 transition-colors focus:ring-4 focus:ring-black/10 mt-2">
            Log In
        </button>
        @if (Route::has('register'))
            <div class="text-center mt-4">
                <span class="text-sm text-black/40">Don't have an account?</span>
                <a href="{{ route('register') }}" class="text-sm font-medium text-black hover:underline ml-1">Create one</a>
            </div>
        @endif
    </form>
</x-guest-layout>
