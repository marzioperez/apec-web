@props(['data'])
<div class="container mx-auto px-4 sm:px-6 lg:px-8 sm:py-14 py-6 scroll-mt-[102px]" id="{{$data['id']}}">
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
            <img src="{{asset('img/video-icon.png')}}" class="absolute top-1/2 -translate-y-1/2 w-16 left-1/2 -translate-x-1/2 cursor-pointer" x-on:click.prevent="$dispatch('open-modal', {name: 'modal-book'})">
            <img src="{{url('storage/web/' . $data['preview'])}}" class="w-full" />
        </div>
        <div class="sm:hidden flex justify-center sm:pt-0 pt-5">
            <button type="button" class="btn btn-primary" x-on:click.prevent="$dispatch('open-modal', {name: 'modal-book'})">{{$data['text_button']}}</button>
        </div>
    </div>

    <x-modal name="modal-book" bg="black" classes="modal-book">
        <x-slot:body>
            <button type="button" class="absolute z-30 rounded-full top-3 right-3 text-white flex items-center justify-center" x-on:click="$dispatch('close-modal')">
                <i class="fa-light fa-xmark text-lg"></i>
            </button>
            <div class="relative">
                <div id="logo-book">
                    @foreach($data['images'] as $item)
                        <div class="w-full">
                            <img src="{{url('storage/web/' . $item['image'])}}" class="w-full">
                        </div>
                    @endforeach
                </div>
                <div class="book-prev-page">
                    <i class="fa-solid fa-chevron-left"></i>
                </div>
                <div class="book-next-page">
                    <i class="fa-solid fa-chevron-right"></i>
                </div>
                <audio id="audio" src="{{asset('audio/page-flip.mp3')}}"></audio>
            </div>
        </x-slot:body>
    </x-modal>
</div>
