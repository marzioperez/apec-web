@props(['options' => []])

@php
    $options = array_merge([
        'dateFormat' => 'Y-m-d',
        'enableTime' => false,
        'inline' => false,
        'altFormat' =>  'd/m/Y',
        'altInput' => true,
        'altInputClass' => 'hidden'
    ], $options);
@endphp

<div wire:ignore>
    <input
        x-data="{
             value: @entangle($attributes->wire('model')),
             instance: undefined,
             init() {
                 $watch('value', value => this.instance.setDate(value, false));
                 this.instance = flatpickr(this.$refs.input, {{ json_encode((object)$options) }});
             }
        }"
        x-init="init"
        x-ref="input"
        type="text"
        {{ $attributes }}
    />
</div>
