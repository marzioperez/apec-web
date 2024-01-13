@props(['name'])
<div class="relative z-50"
     x-data="{show : false, name : '{{$name}}'}"
     x-show="show"
     x-on:open-modal.window="show = ($event.detail.name === name)"
     x-on:close-modal.window="show = false"
     x-on:keydown.escape.window="show = false"
     style="display:none;">

    <div x-on:click="show = false" x-show="show" class="modal-overlay" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

    <div class="modal">
        <div class="modal-wrapper">
            <div class="modal-body" x-show="show" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                {{$body}}
            </div>
        </div>
    </div>
</div>
