@props(['data', 'title'])
<div class="bg-fixed bg-no-repeat bg-contain bg-left-bottom" style="background-image: url('{{asset("img/bg-sign-up-step-2.png")}}')">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 sm:py-20 py-10 relative z-20">
        <div class="sm:grid grid-cols-12 gap-x-12">
            <div class="col-span-full pb-5">
                <div class="sm:w-[650px] mx-auto">
                    <h4 class="text-primary-dark font-semibold sm:text-3xl text-2xl mb-6">{{$title}}</h4>
                    <div class="text-white block-content">{!! $data['content'] !!}</div>
                </div>
            </div>
        </div>
    </div>
</div>
