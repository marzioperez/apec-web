@props(['data'])
<div class="container mx-auto px-4 sm:px-6 lg:px-8 sm:py-14 py-6 scroll-mt-[102px] relative z-10" id="{{$data['id']}}">
    <div class="sm:grid grid-cols-12 gap-6">
        <div class="col-span-full sm:mb-0 mb-4">
            <h4 class="text-primary-dark font-semibold sm:text-2xl text-xl">{{$data['title']}}</h4>
            <h2 class="text-primary-dark font-bold sm:text-5xl text-4xl">{{$data['sub_title']}}</h2>
        </div>

        <div class="col-span-6 flex items-center sm:mb-0 mb-5">
            <div>
                <div class="text-white mb-5">{!! $data['content'] !!}</div>
                <div class="sm:block hidden">
                    <button type="button" class="btn btn-primary" x-on:click.prevent="$dispatch('open-modal', {name: 'modal-book'})">{{$data['text_button']}}</button>
                </div>
            </div>
        </div>
        <div class="col-span-6 flex items-center relative">
            <img src="{{asset('img/video-icon.png')}}" class="absolute top-1/2 -translate-y-1/2 w-16 left-1/2 -translate-x-1/2 cursor-pointer" x-on:click.prevent="$dispatch('open-modal', {name: 'modal-video'})">
            <img src="{{url('storage/web/' . $data['preview'])}}" class="w-full" />
        </div>
        <div class="sm:hidden flex justify-center sm:pt-0 pt-5">
            <button type="button" class="btn btn-primary" x-on:click.prevent="$dispatch('open-modal', {name: 'modal-book'})">{{$data['text_button']}}</button>
        </div>
    </div>
</div>
