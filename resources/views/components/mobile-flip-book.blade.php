@props(['pages' => []])
<div wire:ignore x-data="{
        init() {
            new Splide(this.$refs.splide, {
                perPage: 1,
                arrows: true,
                pagination: false
            }).mount()
        }
    }">
    <div x-ref="splide" class="splide custom-arrows-splide">
        <div class="splide__track">
            <ul class="splide__list">
                @foreach($pages as $item)
                    <li class="splide__slide">
                        <img src="{{url('storage/web/' . $item['image'])}}" class="w-full">
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
