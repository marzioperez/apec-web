<div class="container mx-auto px-4 sm:px-6 lg:px-8 sm:py-14 py-6">
    <div class="sm:grid grid-cols-12 gap-x-12">
        <div class="col-span-full pb-5">
            <h4 class="text-orange font-semibold text-5xl uppercase">{{$data['title']}}</h4>
        </div>
        <div class="col-span-full slider-speakers">
            <div wire:ignore x-data="{
                init() {
                    new Splide(this.$refs.speakers, {
                        perPage: 1,
                        arrows: true,
                        pagination: false
                    }).mount()
                }
            }">
                <div x-ref="speakers" class="splide">
                    <div class="splide__track">
                        <ul class="splide__list">
                            @foreach($speakers as $page)
                                <li class="splide__slide">
                                    <div class="grid sm:grid-cols-3 grid-cols-2 sm:gap-12 gap-6">
                                        @foreach($page as $item)
                                            <x-speaker-item :data="$item" />
                                        @endforeach
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-modal name="modal-speaker" bg="black">
        <x-slot:body>
            <button type="button" class="absolute z-30 rounded-full top-3 right-3 text-white flex items-center justify-center" x-on:click="$dispatch('close-modal')">
                <i class="fa-light fa-xmark text-lg"></i>
            </button>
            <div>
                <div class="mb-3 sm:grid grid-cols-12 gap-6">
                    <div class="col-span-4 flex justify-center sm:mb-0 mb-3">
                        <img src="{{$speaker['photo']}}" class="sm:w-[200px] w-[150px] rounded-full p-2 border-2 border-orange">
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
            </div>
        </x-slot:body>
    </x-modal>
</div>
