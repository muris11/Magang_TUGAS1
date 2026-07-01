<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-6">
        @csrf
        <div>
            <label for="name" class="block text-sm font-medium text-black/70 mb-2">Full Name</label>
            <input id="name" class="block w-full rounded-xl border-black/10 focus:border-black focus:ring-black/5 bg-black/5 px-4 py-3 text-black transition-colors" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500 text-sm" />
        </div>
        <div>
            <label for="email" class="block text-sm font-medium text-black/70 mb-2">Email Address</label>
            <input id="email" class="block w-full rounded-xl border-black/10 focus:border-black focus:ring-black/5 bg-black/5 px-4 py-3 text-black transition-colors" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
        </div>
        <div>
            <label for="password" class="block text-sm font-medium text-black/70 mb-2">Password</label>
            <input id="password" class="block w-full rounded-xl border-black/10 focus:border-black focus:ring-black/5 bg-black/5 px-4 py-3 text-black transition-colors" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
        </div>
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-black/70 mb-2">Confirm Password</label>
            <input id="password_confirmation" class="block w-full rounded-xl border-black/10 focus:border-black focus:ring-black/5 bg-black/5 px-4 py-3 text-black transition-colors" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500 text-sm" />
        </div>
        <button type="submit" class="w-full bg-black text-white rounded-xl py-3.5 font-medium hover:bg-black/80 transition-colors focus:ring-4 focus:ring-black/10 mt-2">
            Register Node
        </button>
        <div class="text-center mt-4">
            <span class="text-sm text-black/40">Already registered?</span>
            <a href="{{ route('login') }}" class="text-sm font-medium text-black hover:underline ml-1">Log in</a>
        </div>
    </form>
</x-guest-layout>
