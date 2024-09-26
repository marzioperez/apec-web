@props(['data'])
@if($data['title'])
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6 scroll-mt-[102px] relative z-10">
        <h3 class="text-white font-semibold text-3xl mb-3">{{$data['title']}}</h3>
        <div class="text-white mb-5">{!! $data['content'] !!}</div>
        @if($data['file'])
            <div class="sm:grid grid-cols-12">
                <div class="col-span-8">
                    <div class="flex justify-center">
                        <a href="{{url('storage/web', $data['file'])}}" target="_blank" class="btn btn-blue">{{$data['text_button']}}</a>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endif
