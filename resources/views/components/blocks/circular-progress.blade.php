@props(['data' => null])
@php
    $progress = 0;
    if (auth()->check()) {
        $progress = auth()->user()->register_progress;
    }
@endphp
<div class="container mx-auto px-4 sm:px-6 lg:px-8 relative py-5">
    <div class="sm:grid grid-cols-12">
        <div class="col-span-8">
            <h3 class="text-white font-semibold text-2xl mb-3">{{$data['title']}}</h3>
            <p class="text-white mb-3">{{$data['sub_title']}}</p>
            <div class="mt-5">
                <a href="{{$data['url']}}" class="btn btn-primary">{{$data['text_button']}}</a>
            </div>
        </div>
        <div class="col-span-4">
            <div class="circular-progress" aria-valuenow="{{$progress}}" aria-valuemin="0" aria-valuemax="100" style="--value:{{$progress}}"></div>
        </div>
    </div>
</div>
