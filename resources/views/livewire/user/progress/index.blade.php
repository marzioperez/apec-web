<div>
    <div class="bg-black py-10 sticky">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative">
            <h3 class="text-white font-semibold text-xl">Registration percentage</h3>
            <p class="text-white mb-3">To ensure the best possible experience, please complete your registration.</p>
            <x-progress :progress="$progress" />
        </div>
    </div>
    <livewire:user.progress.step1 />
</div>
