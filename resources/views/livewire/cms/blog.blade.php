<div class="bg-white sm:py-10 py-10 relative bg-fixed bg-no-repeat bg-contain bg-left-bottom" style="background-image: url('{{asset("img/bg-sign-up-step-4.png")}}')">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
        <div class="py-10 flex justify-center">
            <div class="sm:w-[850px] w-full">
                <h3 class="text-primary-dark font-semibold mb-8 text-2xl text-center">News</h3>
                <div class="sm:grid grid-cols-2 gap-10">
                    @foreach($posts as $post)
                        <a href="{{route('post', ['slug' => $post->slug])}}" class="space-y-2 sm:mb-3 mb-5">
                            <img src="{{url('storage/web/' . $post->image)}}" alt="{{ $post->title }}" class="w-full">
                            <h3 class="text-xl font-bold">{{$post->title}}</h3>
                            <div class="line-clamp-2">{!! $post->summary !!}</div>
                        </a>
                    @endforeach
                </div>
                <div class="pagination">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
