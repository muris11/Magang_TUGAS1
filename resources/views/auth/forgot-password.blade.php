<x-guest-layout>
    <div class="mb-6 text-sm text-black/60 leading-relaxed">
        Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
    </div>
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <form method="POST" action="{{ route('password.email') }}" class="flex flex-col gap-6">
        @csrf
        <div>
            <label for="email" class="block text-sm font-medium text-black/70 mb-2">Email Address</label>
            <input id="email" class="block w-full rounded-xl border-black/10 focus:border-black focus:ring-black/5 bg-black/5 px-4 py-3 text-black transition-colors" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
        </div>
        <button type="submit" class="w-full bg-black text-white rounded-xl py-3.5 font-medium hover:bg-black/80 transition-colors focus:ring-4 focus:ring-black/10 mt-2">
            Email Password Reset Link
        </button>
        <div class="text-center mt-2">
            <a href="{{ route('login') }}" class="text-sm font-medium text-black/60 hover:text-black transition-colors">Return to login</a>
        </div>
    </form>
</x-guest-layout>
