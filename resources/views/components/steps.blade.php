@props(['back_step' => false, 'quantity', 'current', 'complete'])
<div class="relative w-full">
    @if($back_step)
        @if($current > 1)
            <div class="absolute top-2 left-0 cursor-pointer w-full container mx-auto px-4 sm:px-6 lg:px-8 z-20 flex items-center space-x-2" x-on:click.prevent="$dispatch('update-step', {step: {{$current - 1}} })">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12.2559 13.5775L8.67836 9.99997L12.2559 6.42247L11.0775 5.24414L6.32169 9.99997L11.0775 14.7558L12.2559 13.5775Z" fill="black"/>
                </svg>
                <span>Back</span>
            </div>
        @endif
    @endif
    <div class="flex justify-center relative">
        <nav class="steps">
            <ol>
                @foreach(range(1, $quantity) as $step)
                    <li class="{{($step === $current ? 'active' : '')}}{{($step <= $complete ? 'complete' : '')}}">
                        @if($step !== $quantity)
                            <div class="line-content">
                                <div class="line{{($step <= $complete ? ' complete' : '')}}"></div>
                            </div>
                        @endif
                        <div class="bullet">
                            <span class="step">{{$step}}</span>
                        </div>
                    </li>
                @endforeach
            </ol>
        </nav>
    </div>
</div>
