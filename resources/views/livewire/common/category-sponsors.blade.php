<div class="slider-sponsors">
    <div wire:ignore x-data="{
        init() {
            new Splide(this.$refs.sponsors, {
                perPage: 1,
                arrows: false,
                pagination: true
            }).mount()
        }
    }">
        <div x-ref="sponsors" class="splide">
            <div class="splide__track">
                <ul class="splide__list">
                    @foreach($sponsors as $page)
                        <li class="splide__slide">
                            <div class="grid sm:grid-cols-4 grid-cols-2 sm:gap-12 gap-6">
                                @foreach($page as $item)
                                    <div class="w-full bg-white/20 px-6 py-3 rounded-xl cursor-pointer hover:bg-white/30 transition-all" x-on:click.prevent="$dispatch('show-sponsor', {sponsor: {{json_encode($item)}} })">
                                        <img src="{{url('storage/web/' . $item['logo'])}}" />
                                    </div>
                                @endforeach
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
