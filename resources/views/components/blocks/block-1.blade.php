@props(['data'])
<div class="container mx-auto px-4 sm:px-6 lg:px-8 sm:py-14 py-6">
    <div class="sm:grid grid-cols-12 gap-6">
        <div class="col-span-full">
            <h4 class="text-primary-dark font-semibold text-2xl">{{$data['title']}}</h4>
            <h2 class="text-primary-dark font-bold text-5xl">{{$data['sub_title']}}</h2>
        </div>

        <div class="col-span-6 flex items-center">
            <div>
                <div class="text-white mb-5">{!! $data['content'] !!}</div>
                <button type="button" class="btn btn-primary">{{$data['text_button']}}</button>
            </div>
        </div>
        <div class="col-span-6 flex items-center relative">
            <img src="{{asset('img/video-icon.png')}}" class="absolute top-1/2 -translate-y-1/2 w-16 left-1/2 -translate-x-1/2 cursor-pointer">
            <img src="{{url('storage/web/' . $data['preview'])}}" class="w-full" />
        </div>
    </div>
</div>
