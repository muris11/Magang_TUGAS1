<x-app-layout>
    <div class="pt-10 pb-40">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12">
                <div class="inline-block px-3 py-1 rounded-full bg-black/5 border border-black/5 text-[10px] uppercase tracking-[0.2em] font-medium mb-4">
                    Account Settings
                </div>
                <h1 class="text-4xl font-bold tracking-tighter text-[#050505] font-[Geist] leading-none">
                    System Profile
                </h1>
            </div>
            <div class="flex flex-col gap-8">
                <div class="p-1.5 rounded-[2rem] bg-black/5 border border-black/5">
                    <div class="relative bg-white rounded-[calc(2rem-0.375rem)] shadow-[inset_0_1px_1px_rgba(255,255,255,0.8)] p-8 sm:p-12">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
                <div class="p-1.5 rounded-[2rem] bg-black/5 border border-black/5">
                    <div class="relative bg-white rounded-[calc(2rem-0.375rem)] shadow-[inset_0_1px_1px_rgba(255,255,255,0.8)] p-8 sm:p-12">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
                <div class="p-1.5 rounded-[2rem] bg-red-500/5 border border-red-500/10">
                    <div class="relative bg-white rounded-[calc(2rem-0.375rem)] shadow-[inset_0_1px_1px_rgba(255,255,255,0.8)] p-8 sm:p-12">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
