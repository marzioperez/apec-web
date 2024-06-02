<div class="bg-white sm:py-10 py-10 relative bg-fixed bg-no-repeat bg-contain bg-left-bottom" style="background-image: url('{{asset("img/bg-sign-up-step-4.png")}}')">

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-20">
        <div class="py-10 flex justify-center">
            <div class="sm:w-[650px] w-full">
                <h3 class="text-primary-dark font-semibold mb-3 text-2xl">General questions</h3>
                <div class="my-8" x-data="{ current_faq: null }">
                    @foreach($faqs as $faq)
                        <div class="w-full py-5" style="border-bottom: 1px solid #000;" x-data="{
                            faq: {{$faq['id']}},
                            get expanded() {
                                return this.current_faq === this.faq
                            },
                            set expanded(value) {
                                this.current_faq = value ? this.faq : null
                            }
                        }">
                            <div class="cursor-pointer pt-1 flex w-full items-center space-x-5" x-on:click="expanded = !expanded" :aria-expanded="expanded">
                                <svg width="8" height="12" viewBox="0 0 8 12" fill="none" aria-hidden="true" class="transition-all" :class="expanded ? 'rotate-90' : ''">
                                    <path d="M1.70706 11.707L7.41406 6.00003L1.70706 0.293031L0.293062 1.70703L4.58606 6.00003L0.293063 10.293L1.70706 11.707Z" fill="black"/>
                                </svg>
                                <h3 class="font-semibold">{{$faq['question']}}</h3>
                            </div>
                            <div class="py-3" x-show="expanded" x-collapse>{!! $faq['answer'] !!}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
