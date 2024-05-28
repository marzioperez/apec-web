@props(['data' => null])
<div class="slider">
    <div wire:ignore x-data="{
        init() {
            new Splide(this.$refs.splide, {
                perPage: 1,
                arrows: false
            }).mount()
        }
    }">
        <div x-ref="splide" class="splide">
            <div class="splide__track">
                <ul class="splide__list">
                    @foreach($data['images'] as $item)
                        <li class="splide__slide">
                            <img src="{{url('storage/web/' . $item['image'])}}" class="w-full" />
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="content">
            <img src="{{url('storage/web/' . $data['logo'])}}" class="logo" />
            <div class="inner">
                <x-countdown :date="$data['counter_date']" />
                <div class="my-2">{!! $data['content'] !!}</div>
            </div>
            @if($data['text_button'])
                @if(auth()->guest())
                    <a href="{{$data['url']}}" class="btn btn-secondary">{{$data['text_button']}}</a>
                @endif
            @endif
        </div>
    </div>
    <img src="{{asset('img/bg-banner-right.png')}}" class="absolute -bottom-1/3 right-0 w-[300px] z-[5]">
</div>
