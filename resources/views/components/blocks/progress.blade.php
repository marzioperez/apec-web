@props(['data' => null])
@php
    $progress = 0;
    if (auth()->check()) {
        $progress = auth()->user()->register_progress;
    }
@endphp
<div x-data="{
        currentVal: {{$progress}},
        minVal: 0,
        maxVal: 100,
        calcPercentage(min, max, val){
            return ((val-min)/(max-min))*100
        }
    }"
     class="container mx-auto px-4 sm:px-6 lg:px-8 relative py-5 scroll-mt-[102px] relative z-10" id="{{$data['id']}}">
    <h3 class="text-white font-semibold text-2xl text-center mb-3">{{$data['title']}}</h3>
    <p class="text-white mb-3 text-center">{{str_replace("#progress#", $progress, $data['sub_title']) }}</p>
    <div class="progress" :aria-valuenow="currentVal" :aria-valuemin="minVal" :aria-valuemax="maxVal">
        <div class="line" :style="`width: ${calcPercentage(minVal, maxVal, currentVal)}%; transition: 1s;`"></div>
    </div>
    <div class="flex justify-center py-3 mt-5">
        <a href="{{$data['url']}}" class="btn btn-primary">{{$data['text_button']}}</a>
    </div>
</div>
