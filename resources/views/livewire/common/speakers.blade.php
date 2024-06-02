<div>
    @if(count($speakers) > 0)
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 sm:py-14 py-6 relative z-10 scroll-mt-[102px]" id="{{$data['id']}}">
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
        </div>
    @endif
</div>
