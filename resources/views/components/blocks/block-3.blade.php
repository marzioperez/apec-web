@props(['data'])
<div class="container mx-auto px-4 sm:px-6 lg:px-8 sm:py-14 py-6 relative z-20 scroll-mt-[102px]" id="{{$data['id']}}">
    <div class="sm:grid grid-cols-12 gap-x-12">
        <div class="col-span-full pb-5">
            <h4 class="text-blue font-semibold sm:text-5xl text-4xl uppercase">{{$data['title']}}</h4>
        </div>
        <div class="contact-block">
            @foreach($data['elementos'] as $item)
                <div>{!! $item['content'] !!}</div>
            @endforeach
        </div>
    </div>
</div>
