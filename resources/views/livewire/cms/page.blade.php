<div>
    @foreach($blocks as $block)
        @if($block['type'] === 'banner')
            <x-blocks.banner :data="$block['data']" />
        @endif

        @if($block['type'] === 'progress')
            @if(auth()->check())
                <x-blocks.progress :data="$block['data']" />
            @endif
       @endif

        @if($block['type'] === 'block-1')
            <x-blocks.block-1 :data="$block['data']" />
        @endif

        @if($block['type'] === 'block-2')
            <x-blocks.block-2 :data="$block['data']" />
        @endif

        @if($block['type'] === 'block-3')
            <x-blocks.block-3 :data="$block['data']" />
       @endif

        @if($block['type'] === 'program')
            <livewire:common.program :data="$block['data']" />
        @endif

        @if($block['type'] === 'circular-progress')
            @if(auth()->check())
                <x-blocks.circular-progress :data="$block['data']" />
            @endif
        @endif

        @if($block['type'] === 'hotels')
            @if(auth()->check())
                <livewire:common.hotels :data="$block['data']" />
            @endif
        @endif

        @if($block['type'] === 'speakers')
            <livewire:common.speakers :data="$block['data']" />
        @endif

        @if($block['type'] === 'sponsors')
            <livewire:common.sponsors :data="$block['data']" />
        @endif

        @if($block['type'] === 'news')
            <livewire:common.news :data="$block['data']" />
        @endif

        @if($block['type'] === 'block-1')
            <x-modal name="modal-book" bg="black" classes="modal-book">
                <x-slot:body>
                    <button type="button" class="absolute z-30 rounded-full top-3 right-3 text-white flex items-center justify-center" x-on:click="$dispatch('close-modal')">
                        <i class="fa-light fa-xmark text-lg"></i>
                    </button>
                    <div class="relative">
                        <div id="logo-book">
                            @foreach($block['data']['images'] as $item)
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
        @endif

            @if($block['type'] === 'block-2')
                <x-modal name="modal-organization" bg="black !p-0" classes="modal-book">
                    <x-slot:body>
                        <button type="button" class="absolute z-30 rounded-full top-3 right-3 text-white flex items-center justify-center" x-on:click="$dispatch('close-modal')">
                            <i class="fa-light fa-xmark text-lg"></i>
                        </button>
                        <div class="w-full sm:grid grid-cols-12">
                            <div class="col-span-7 flex items-center justify-center sm:px-10 px-5">
                                <div>
                                    <h3 class="text-secondary text-3xl mb-3 font-bold">{{$block['data']['pop_up_title']}}</h3>
                                    <div class="text-white text-sm">{!! $block['data']['pop_up_content'] !!}</div>
                                </div>
                            </div>
                            <div class="col-span-5">
                                <img src="{{url('storage/web/' . $block['data']['pop_up_image'])}}" class="w-full">
                            </div>
                        </div>
                    </x-slot:body>
                </x-modal>
            @endif
    @endforeach
</div>
