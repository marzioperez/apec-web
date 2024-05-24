@props(['data'])
<div class="container mx-auto px-4 sm:px-6 lg:px-8 sm:py-14 py-6">
    <div class="sm:grid grid-cols-12 gap-x-12">
        <div class="col-span-full pb-5">
            <h4 class="text-secondary font-semibold text-5xl uppercase">{{$data['title']}}</h4>
            <h2 class="text-secondary font-bold text-2xl uppercase">{{$data['sub_title']}}</h2>
        </div>

        <div class="col-span-8">
            <div>
                <div class="text-white mb-5">{!! $data['content'] !!}</div>
                <button type="button" class="btn btn-secondary">{{$data['text_button']}}</button>
            </div>
        </div>
        <div class="col-span-4 flex items-center relative">
            <img src="{{url('storage/web/' . $data['image'])}}" class="w-full" />
        </div>
    </div>
</div>
