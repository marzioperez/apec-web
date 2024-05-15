<div x-data="{ step: {{$current_step}}}"
     x-on:update-step.window="step = $event.detail.step">
    <div class="bg-black py-10">
        <x-progress :progress="$progress" />
    </div>

    <div x-show="step < 1"><livewire:user.progress.step1 :user="$user" /></div>
    <div x-show="step === 2"><livewire:user.progress.step2 :user="$user" /></div>
    <div x-show="step === 3"><livewire:user.progress.step3 :user="$user" /></div>
    <div x-show="step === 4"><livewire:user.progress.step4 :user="$user" /></div>
    <div x-show="step === 5"><livewire:user.progress.step5 :user="$user" /></div>
</div>
