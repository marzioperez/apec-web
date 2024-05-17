<div x-data="{ step: {{$current_step}}}"
     x-on:update-step.window="step = $event.detail.step">
    <div class="bg-black py-10">
        <x-progress :progress="$progress" />
    </div>

    <div x-show="step <= 1"><livewire:user.progress.step1 :user="$user" :quantity="4" /></div>
    <div x-show="step === 2"><livewire:user.progress.step3 :user="$user" :quantity="4" :current="2" :complete="1" /></div>
    <div x-show="step === 3"><livewire:user.progress.step4 :user="$user" :quantity="4" :current="3" :complete="2" /></div>
    <div x-show="step === 4"><livewire:user.progress.step5 :user="$user" :quantity="4" :current="5" :complete="3" /></div>
</div>
