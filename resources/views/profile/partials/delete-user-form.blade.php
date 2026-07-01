<section class="space-y-6">
    <header>
        <h2 class="text-xl font-bold text-red-600 font-[Geist] tracking-tight">
            Delete Account
        </h2>
        <p class="mt-2 text-sm text-red-500/80 leading-relaxed">
            Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
        </p>
    </header>
    <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" class="bg-red-600 text-white px-6 py-2.5 rounded-xl font-medium hover:bg-red-700 transition-colors focus:ring-4 focus:ring-red-600/20 shadow-sm border-none uppercase tracking-wide text-xs">
        Delete Account
    </x-danger-button>
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8">
            @csrf
            @method('delete')
            <h2 class="text-xl font-bold text-black font-[Geist] tracking-tight">
                Are you sure you want to delete your account?
            </h2>
            <p class="mt-2 text-sm text-black/60 leading-relaxed">
                Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.
            </p>
            <div class="mt-6">
                <label for="password" class="sr-only">Password</label>
                <input id="password" name="password" type="password" class="block w-full rounded-xl border-black/10 focus:border-red-500 focus:ring-red-500/20 bg-black/5 px-4 py-3 text-black transition-colors" placeholder="Password" />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-red-500 text-sm" />
            </div>
            <div class="mt-8 flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')" class="bg-black/5 text-black px-6 py-2.5 rounded-xl font-medium hover:bg-black/10 transition-colors focus:ring-4 focus:ring-black/5">
                    Cancel
                </button>
                <button type="submit" class="bg-red-600 text-white px-6 py-2.5 rounded-xl font-medium hover:bg-red-700 transition-colors focus:ring-4 focus:ring-red-600/20 shadow-sm border-none">
                    Delete Account
                </button>
            </div>
        </form>
    </x-modal>
</section>
