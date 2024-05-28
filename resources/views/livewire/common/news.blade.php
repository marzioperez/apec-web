<div>
    @if(count($posts) > 2)
        <div class="sm:py-10 py-5 sm:px-0 px-6">
            <div class="container mx-auto px-0 sm:px-6 lg:px-8 relative z-20 space-y-6">
                <div class="flex sm:justify-between items-center">
                    <h1 class="text-secondary text-5xl font-bold uppercase">{{$data['title']}}</h1>
                </div>
                <div class="sm:grid grid-cols-12 gap-6">
                    <div class="col-span-8">
                        <x-post-item :post="$posts[0]" />
                    </div>
                    <div class="col-span-4 space-y-6">
                        <x-post-item :post="$posts[1]" :style="2" />
                        <x-post-item :post="$posts[2]" :style="2" />
                    </div>
                </div>
                <div class="flex justify-center">
                    <a href="{{route('news')}}" class="btn btn-secondary">{{$data['text_button']}}</a>
                </div>
            </div>
        </div>
    @endif
</div>
