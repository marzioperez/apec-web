<div class="bg-white sm:py-10 py-10 relative bg-fixed bg-no-repeat bg-contain bg-left-bottom" style="background-image: url('{{asset("img/bg-sign-up-step-4.png")}}')">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
        <div class="py-10 flex justify-center">
            <div class="sm:w-[850px] w-full">
                <h3 class="text-primary-dark font-semibold mb-8 text-2xl">{{$post->title}}</h3>
                <img src="{{url('storage/web/' . $post->image)}}" alt="{{ $post->title }}" class="w-full mb-6">
                <div>{!! $post->content !!}</div>
            </div>
        </div>
    </div>
</div>
