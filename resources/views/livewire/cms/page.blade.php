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

        @if($block['type'] === 'block-4')
            <x-blocks.block-4 :data="$block['data']" :title="$page['name']" />
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

            <x-modal name="modal-video" bg="black" classes="modal-book">
                <x-slot:body>
                    <button type="button" class="absolute z-30 rounded-full top-3 right-3 text-white flex items-center justify-center" x-on:click="$dispatch('close-modal')">
                        <i class="fa-light fa-xmark text-lg"></i>
                    </button>
                    <div class="relative">
                        {!! $block['data']['embed'] !!}
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

        @if($block['type'] === 'hotels')
            <x-modal name="modal-hotel" bg="black">
                    <x-slot:body>
                        <button type="button" class="absolute z-30 rounded-full top-3 right-3 text-white flex items-center justify-center" x-on:click="$dispatch('close-modal')">
                            <i class="fa-light fa-xmark text-lg"></i>
                        </button>
                        @if($hotel)
                            <div>
                                <div class="mb-3 sm:grid grid-cols-12">
                                    <div class="col-span-full px-6 py-3">
                                        <img src="{{url('storage/web/' . $hotel['photo'])}}" class="w-full">
                                    </div>
                                    <div class="col-span-full">
                                        <h6 class="text-white font-semibold text-lg sm:text-start text-center">{{$hotel['name']}}</h6>
                                    </div>
                                    <div class="col-span-full">
                                        @foreach(range(1, $hotel['stars'])  as $star)
                                            <i class="fa-sharp fa-solid fa-star text-white text-sm"></i>
                                        @endforeach
                                    </div>
                                    <div class="col-span-full mt-5 text-sm text-white">
                                        {!! $hotel['description'] !!}
                                    </div>
                                    @if($hotel['social_networks'])
                                        <div class="flex space-x-2 mt-4 sm:justify-start justify-center">
                                            @foreach($hotel['social_networks'] as $item)
                                                <a href="{{$item['data']['url']}}" target="_blank" class="btn-speaker-social">
                                                    @if($item['type'] === 'linkedin')
                                                        <i class="fa-brands fa-linkedin-in"></i>
                                                    @endif
                                                    @if($item['type'] === 'facebook')
                                                        <i class="fa-brands fa-facebook-f"></i>
                                                    @endif
                                                    @if($item['type'] === 'web')
                                                        <i class="fa-light fa-globe"></i>
                                                    @endif
                                                    @if($item['type'] === 'instagram')
                                                        <i class="fa-brands fa-instagram"></i>
                                                    @endif
                                                    @if($item['type'] === 'x')
                                                        <i class="fa-brands fa-x-twitter"></i>
                                                    @endif
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </x-slot:body>
                </x-modal>
        @endif
    @endforeach
</div>
