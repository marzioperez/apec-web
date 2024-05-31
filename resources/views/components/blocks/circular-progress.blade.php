@props(['data' => null])
@php
    $progress = 0;
    if (auth()->check()) {
        $progress = auth()->user()->register_progress;
    }
@endphp
<div class="container mx-auto px-4 sm:px-6 lg:px-8 relative py-5 scroll-mt-[102px] relative z-10" id="{{$data['id']}}">
    <div class="sm:grid grid-cols-12">
        <div class="col-span-8 sm:text-left text-center">
            <h3 class="text-white font-semibold text-2xl mb-3">{{$data['title']}}</h3>
            <p class="text-white mb-3">{{$data['sub_title']}}</p>
            <div class="mt-5 sm:block hidden">
                <a href="{{$data['url']}}" class="btn btn-primary">{{$data['text_button']}}</a>
            </div>
        </div>
        <div class="col-span-4 flex sm:justify-start justify-center sm:py-0 py-3">
            <div>
                <div class="circular-progress" aria-valuenow="{{$progress}}" aria-valuemin="0" aria-valuemax="100" style="--value:{{$progress}}"></div>
                <div class="mt-5 sm:hidden block">
                    <a href="{{$data['url']}}" class="btn btn-primary">{{$data['text_button']}}</a>
                </div>
            </div>
        </div>
    </div>
</div>
