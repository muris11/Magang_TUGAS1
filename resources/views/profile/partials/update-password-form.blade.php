<section>
    <header class="mb-8">
        <h2 class="text-xl font-bold text-black font-[Geist] tracking-tight">
            Update Password
        </h2>
        <p class="mt-2 text-sm text-black/60 leading-relaxed">
            Ensure your account is using a long, random password to stay secure.
        </p>
    </header>
    <form method="post" action="{{ route('password.update') }}" class="flex flex-col gap-6 max-w-xl">
        @csrf
        @method('put')
        <div>
            <label for="update_password_current_password" class="block text-sm font-medium text-black/70 mb-2">Current Password</label>
            <input id="update_password_current_password" name="current_password" type="password" class="block w-full rounded-xl border-black/10 focus:border-black focus:ring-black/5 bg-black/5 px-4 py-3 text-black transition-colors" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-red-500 text-sm" />
        </div>
        <div>
            <label for="update_password_password" class="block text-sm font-medium text-black/70 mb-2">New Password</label>
            <input id="update_password_password" name="password" type="password" class="block w-full rounded-xl border-black/10 focus:border-black focus:ring-black/5 bg-black/5 px-4 py-3 text-black transition-colors" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-red-500 text-sm" />
        </div>
        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-medium text-black/70 mb-2">Confirm Password</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="block w-full rounded-xl border-black/10 focus:border-black focus:ring-black/5 bg-black/5 px-4 py-3 text-black transition-colors" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-red-500 text-sm" />
        </div>
        <div class="flex items-center gap-4 mt-2">
            <button type="submit" class="bg-black text-white px-6 py-2.5 rounded-xl font-medium hover:bg-black/80 transition-colors focus:ring-4 focus:ring-black/10">
                Update Password
            </button>
            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-black/60 font-medium">Saved.</p>
            @endif
        </div>
    </form>
</section>
