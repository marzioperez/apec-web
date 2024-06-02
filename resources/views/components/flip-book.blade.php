@props(['pages' => []])
<div class="relative">
    <div id="logo-book">
        @foreach($pages as $item)
            <div class="w-full">
                <img src="{{url('storage/web/' . $item['image'])}}" class="w-full">
            </div>
        @endforeach
    </div>
    <div class="book-prev-page">
        <i class="fa-solid fa-chevron-left"></i>
    </div>
    <div class="book-next-page">
        <i class="fa-solid fa-chevron-right"></i>
    </div>
    <audio id="audio" src="{{asset('audio/page-flip.mp3')}}"></audio>
</div>
