<div x-data="{ step: {{$current_step}}}" x-on:update-step.window="step = $event.detail.step">
    <div x-show="step <= 1">
        <livewire:user.flight.step1 :user="$user" />
    </div>
    <div x-show="step === 2">
        <livewire:user.flight.step2 :user="$user" />
    </div>
</div>
