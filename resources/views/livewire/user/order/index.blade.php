<div x-data="{ step: {{$current_step}}}" x-on:update-step.window="step = $event.detail.step">
    <div x-show="step <= 1">
        <livewire:user.order.step1 :order="$order" />
    </div>
    <div x-show="step === 2">
        <livewire:user.order.step2 :order="$order" />
    </div>
</div>
