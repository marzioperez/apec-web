<div x-data="{
    step: {{$current_step}}
}"
     x-on:update-step.window="step = $event.detail.step"
>
    <div class="bg-black py-10 sticky">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative">
            <h3 class="text-white font-semibold text-xl">Registration percentage</h3>
            <p class="text-white mb-3">To ensure the best possible experience, please complete your registration.</p>
            <x-progress :progress="$progress" />
        </div>
    </div>
    <div x-show="step < 1"><livewire:user.progress.step1 :user="$user" /></div>
    <div x-show="step === 2"><livewire:user.progress.step2 :user="$user" /></div>
</div>
