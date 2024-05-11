@aware(['quantity', 'current', 'complete'])
<div class="flex justify-center">
    <nav class="steps">
        <ol>
            @foreach(range(1, $quantity) as $step)
                <li class="{{($step === $current ? 'active' : '')}}{{($step === $complete ? 'complete' : '')}}">
                    @if($step !== $quantity)
                        <div class="line-content">
                            <div class="line"></div>
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
