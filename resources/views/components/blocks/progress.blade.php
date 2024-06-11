@props(['data' => null])
@php
    $progress = 0;
    $user = null;
    if (auth()->check()) {
        $user = auth()->user();
    }
@endphp
<div x-data="{
        currentVal: {{$user['register_progress']}},
        minVal: 0,
        maxVal: 100,
        calcPercentage(min, max, val){
            return ((val-min)/(max-min))*100
        }
    }"
     class="container mx-auto px-4 sm:px-6 lg:px-8 py-6 scroll-mt-[102px] relative z-10" id="{{$data['id']}}">
    @if(in_array($user['status'], [\App\Concerns\Enums\Status::CONFIRMED->value]))
        <h3 class="text-white font-semibold text-2xl text-center mb-5">How to  complete you registration?</h3>
    @endif

    @if(in_array($user['type'], [
        \App\Concerns\Enums\Types::PARTICIPANT->value,
        \App\Concerns\Enums\Types::STAFF->value,
        \App\Concerns\Enums\Types::COMPANION->value,
        \App\Concerns\Enums\Types::VIP->value,
    ]))
        @if(in_array($user['status'], [\App\Concerns\Enums\Status::UNPAID->value]))
            <h3 class="text-white font-semibold text-2xl text-center mb-5">To continue the process please complete your payment</h3>
      @endif
   @endif

    @if(in_array($user['status'], [
        \App\Concerns\Enums\Status::PENDING_APPROVAL_DATA->value,
        \App\Concerns\Enums\Status::SEND_TO_CHANCELLERY->value,
        \App\Concerns\Enums\Status::ERROR_IN_CHANCELLERY->value,
        \App\Concerns\Enums\Status::PENDING_ACCREDITATION->value,
        \App\Concerns\Enums\Status::OBSERVED_ACCREDITATION->value,
        \App\Concerns\Enums\Status::CANCEL_ACCREDITATION->value,
        \App\Concerns\Enums\Status::ACCREDITED->value,
        \App\Concerns\Enums\Status::PENDING_CORRECT_DATA->value
    ]))
        <h3 class="text-white font-semibold text-3xl text-center mb-3">Want to use our complimentary shuttle service?</h3>
        <p class="text-white text-center mb-5">Don’t forget to let us know your travel and accommodation arrangements</p>
   @endif

    <div class="progress" :aria-valuenow="currentVal" :aria-valuemin="minVal" :aria-valuemax="maxVal">
        <div class="line" :style="`width: ${calcPercentage(minVal, maxVal, currentVal)}%; transition: 1s;`"></div>
    </div>
    <div class="sm:flex justify-center py-3 mt-5 space-x-6">
        @if(in_array($user['status'], [
            \App\Concerns\Enums\Status::CONFIRMED->value
        ]))
            <a href="{{$data['url']}}" class="btn btn-primary">{{$data['text_button']}}</a>
        @endif

        @if(in_array($user['status'], [
            \App\Concerns\Enums\Status::ERROR_IN_CHANCELLERY->value,
            \App\Concerns\Enums\Status::PENDING_ACCREDITATION->value,
            \App\Concerns\Enums\Status::OBSERVED_ACCREDITATION->value,
            \App\Concerns\Enums\Status::CANCEL_ACCREDITATION->value,
            \App\Concerns\Enums\Status::ACCREDITED->value,
            \App\Concerns\Enums\Status::SEND_TO_CHANCELLERY->value
        ]))
            <div class="flex justify-center">
                <a href="{{route('qr')}}" class="btn btn-primary sm:mb-0 mb-3">View my QR </a>
            </div>
         @endif

        @if(in_array($user['type'], [
            \App\Concerns\Enums\Types::PARTICIPANT->value,
            \App\Concerns\Enums\Types::STAFF->value,
            \App\Concerns\Enums\Types::COMPANION->value,
            \App\Concerns\Enums\Types::VIP->value,
        ]))
            @if(in_array($user['status'], [\App\Concerns\Enums\Status::UNPAID->value]))
                <a href="{{route('progress')}}" class="btn btn-primary">Complete your payment</a>
             @endif
         @endif

        @if(in_array($user['status'], [
            \App\Concerns\Enums\Status::PENDING_APPROVAL_DATA->value,
            \App\Concerns\Enums\Status::SEND_TO_CHANCELLERY->value,
            \App\Concerns\Enums\Status::ERROR_IN_CHANCELLERY->value,
            \App\Concerns\Enums\Status::PENDING_ACCREDITATION->value,
            \App\Concerns\Enums\Status::OBSERVED_ACCREDITATION->value,
            \App\Concerns\Enums\Status::CANCEL_ACCREDITATION->value,
            \App\Concerns\Enums\Status::ACCREDITED->value,
            \App\Concerns\Enums\Status::PENDING_CORRECT_DATA->value
        ]))
            <a href="{{route('hotel')}}" class="btn btn-primary">Complete flight and  booking accomodation</a>
         @endif
    </div>
</div>
