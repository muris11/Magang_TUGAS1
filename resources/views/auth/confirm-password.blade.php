<x-guest-layout>
    <div class="mb-6 text-sm text-black/60 leading-relaxed">
        This is a secure area of the application. Please confirm your password before continuing.
    </div>
    <form method="POST" action="{{ route('password.confirm') }}" class="flex flex-col gap-6">
        @csrf
        <div>
            <label for="password" class="block text-sm font-medium text-black/70 mb-2">Password</label>
            <input id="password" class="block w-full rounded-xl border-black/10 focus:border-black focus:ring-black/5 bg-black/5 px-4 py-3 text-black transition-colors" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
        </div>
        <button type="submit" class="w-full bg-black text-white rounded-xl py-3.5 font-medium hover:bg-black/80 transition-colors focus:ring-4 focus:ring-black/10 mt-2">
            Confirm
        </button>
    </form>
</x-guest-layout>
