<x-guest-layout>
    <div class="mb-6 text-sm text-black/60 leading-relaxed">
        Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
    </div>
    @if (session('status') == 'verification-link-sent')
        <div class="mb-6 font-medium text-sm text-green-600 bg-green-50 p-4 rounded-xl">
            A new verification link has been sent to the email address you provided during registration.
        </div>
    @endif
    <div class="mt-8 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="bg-black text-white px-6 py-2.5 rounded-xl font-medium hover:bg-black/80 transition-colors focus:ring-4 focus:ring-black/10">
                Resend Verification Email
            </button>
        </form>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-sm text-black/60 hover:text-black font-medium transition-colors">
                Log Out
            </button>
        </form>
    </div>
</x-guest-layout>
