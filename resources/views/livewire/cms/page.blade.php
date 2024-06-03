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
            <x-modal name="modal-book" bg="black" classes="modal-book">
                <x-slot:body>
                    <button type="button" class="absolute z-30 rounded-full top-3 right-3 text-white flex items-center justify-center" x-on:click="$dispatch('close-modal')">
                        <i class="fa-light fa-xmark text-lg"></i>
                    </button>
                    <div class="sm:block hidden">
                        <x-flip-book :pages="$block['data']['images']" />
                    </div>

                    <div class="sm:hidden block">
                        <x-mobile-flip-book :pages="$block['data']['images']" />
                    </div>
                </x-slot:body>
            </x-modal>
        @endif

        @if($block['type'] === 'block-2')
            <x-blocks.block-2 :data="$block['data']" />
                <x-modal name="modal-organization" bg="black !px-0 !py-0" classes="modal-book">
                    <x-slot:body>
                        <button type="button" class="absolute z-30 rounded-full top-3 right-3 text-white flex items-center justify-center" x-on:click="$dispatch('close-modal')">
                            <i class="fa-light fa-xmark text-lg"></i>
                        </button>
                        <img src="{{asset('img/organization-mobile.png')}}" class="w-full sm:hidden block">

                        <div class="w-full sm:grid grid-cols-12">
                            <div class="col-span-7 flex items-center justify-center sm:px-10 px-5 sm:pt-0 pt-6 sm:pb-0 pb-6">
                                <div>
                                    <h3 class="text-secondary text-3xl mb-3 font-bold">{{$block['data']['pop_up_title']}}</h3>
                                    <div class="text-white text-sm">{!! $block['data']['pop_up_content'] !!}</div>
                                </div>
                            </div>
                            <div class="col-span-5 sm:block hidden">
                                <img src="{{url('storage/web/' . $block['data']['pop_up_image'])}}" class="w-full">
                            </div>
                        </div>
                    </x-slot:body>
                </x-modal>
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
        @endif

        @if($block['type'] === 'speakers')
            <livewire:common.speakers :data="$block['data']" />
                <x-modal name="modal-speaker" bg="black">
                    <x-slot:body>
                        <button type="button" class="absolute z-30 rounded-full top-3 right-3 text-white flex items-center justify-center" x-on:click="$dispatch('close-modal')">
                            <i class="fa-light fa-xmark text-lg"></i>
                        </button>
                        <div>
                            @if($speaker)
                                <div class="mb-3 sm:grid grid-cols-12 gap-6">
                                <div class="col-span-4 flex justify-center sm:mb-0 mb-3">
                                    <img src="{{url('storage/web/' . $speaker['photo'])}}" class="sm:w-[200px] w-[150px] rounded-full p-2 border-2 border-orange">
                                </div>
                                <div class="col-span-8">
                                    <h6 class="text-orange font-semibold text-lg mb-2 sm:text-start text-center">{{$speaker['name']}}</h6>
                                    <div class="text-white line-clamp-2 text-sm mb-4 sm:text-start text-center">{!! $speaker['summary'] !!}</div>
                                    <div class="text-white font-semibold sm:text-start text-center">{{$speaker['company']}}</div>
                                    @if($speaker['social_networks'])
                                        <div class="flex space-x-2 mt-4 sm:justify-start justify-center">
                                            @foreach($speaker['social_networks'] as $item)
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
                                <div class="col-span-full mt-5 text-sm text-white">
                                    {!! $speaker['biography'] !!}
                                </div>
                            </div>
                            @endif
                        </div>
                    </x-slot:body>
                </x-modal>
        @endif

        @if($block['type'] === 'sponsors')
            <livewire:common.sponsors :data="$block['data']" />
                <x-modal name="modal-sponsor" bg="black">
                    <x-slot:body>
                        <button type="button" class="absolute z-30 rounded-full top-3 right-3 text-white flex items-center justify-center" x-on:click="$dispatch('close-modal')">
                            <i class="fa-light fa-xmark text-lg"></i>
                        </button>
                        @if($sponsor)
                            <div>
                                <div class="mb-3 sm:grid grid-cols-12 gap-6">
                                    <div class="col-span-5 flex justify-center sm:mb-0 mb-3">
                                        <img src="{{url('storage/web/' . $sponsor['logo'])}}" class="object-center w-full">
                                    </div>
                                    <div class="col-span-7 flex items-center">
                                        <div>
                                            <h6 class="text-white font-semibold text-lg mb-2 sm:text-start text-center">{{$sponsor['name']}}</h6>
                                            @if($sponsor['social_networks'])
                                                <div class="flex space-x-2 mt-4 sm:justify-start justify-center">
                                                    @foreach($sponsor['social_networks'] as $item)
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
                                    <div class="col-span-full mt-5 text-sm text-white">
                                        {!! $sponsor['description'] !!}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </x-slot:body>
                </x-modal>
        @endif

        @if($block['type'] === 'news')
            <livewire:common.news :data="$block['data']" />
        @endif

    @endforeach
</div>
