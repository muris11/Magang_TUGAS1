<section>
    <header class="mb-8">
        <h2 class="text-xl font-bold text-black font-[Geist] tracking-tight">
            Profile Information
        </h2>
        <p class="mt-2 text-sm text-black/60 leading-relaxed">
            Update your account's profile information and email address.
        </p>
    </header>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
    <form method="post" action="{{ route('profile.update') }}" class="flex flex-col gap-6 max-w-xl">
        @csrf
        @method('patch')
        <div>
            <label for="name" class="block text-sm font-medium text-black/70 mb-2">Name</label>
            <input id="name" name="name" type="text" class="block w-full rounded-xl border-black/10 focus:border-black focus:ring-black/5 bg-black/5 px-4 py-3 text-black transition-colors" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2 text-red-500 text-sm" :messages="$errors->get('name')" />
        </div>
        <div>
            <label for="email" class="block text-sm font-medium text-black/70 mb-2">Email</label>
            <input id="email" name="email" type="email" class="block w-full rounded-xl border-black/10 focus:border-black focus:ring-black/5 bg-black/5 px-4 py-3 text-black transition-colors" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2 text-red-500 text-sm" :messages="$errors->get('email')" />
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-4 text-sm text-black/60 bg-black/5 p-4 rounded-xl border border-black/5">
                    <p>
                        Your email address is unverified.
                        <button form="send-verification" class="underline text-black hover:text-black/70 font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black transition-colors">
                            Click here to re-send the verification email.
                        </button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-green-600">
                            A new verification link has been sent to your email address.
                        </p>
                    @endif
                </div>
            @endif
        </div>
        <div class="flex items-center gap-4 mt-2">
            <button type="submit" class="bg-black text-white px-6 py-2.5 rounded-xl font-medium hover:bg-black/80 transition-colors focus:ring-4 focus:ring-black/10">
                Save Changes
            </button>
            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-black/60 font-medium">Saved.</p>
            @endif
        </div>
    </form>
</section>
