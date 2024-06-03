@props(['data' => null])
@php
    $progress = 0;
    $user = null;
    if (auth()->check()) {
        $user = auth()->user();
        $progress = $user->register_progress;
    }
@endphp
<div class="container mx-auto px-4 sm:px-6 lg:px-8 relative py-5 scroll-mt-[102px] relative z-10" id="{{$data['id']}}">
    <div class="sm:grid grid-cols-12">
        <div class="col-span-8 sm:text-left text-center">
            @if(in_array($user['status'], [\App\Concerns\Enums\Status::CONFIRMED->value]))
                <h3 class="text-white font-semibold text-2xl mb-3">How to  complete you registration?</h3>
            @endif

            @if(in_array($user['type'], [
                \App\Concerns\Enums\Types::PARTICIPANT->value,
                \App\Concerns\Enums\Types::STAFF->value,
                \App\Concerns\Enums\Types::COMPANION->value,
                \App\Concerns\Enums\Types::VIP->value,
            ]))
                @if(in_array($user['status'], [\App\Concerns\Enums\Status::UNPAID->value]))
                    <h3 class="text-white font-semibold text-2xl mb-3">To continue the process please complete your payment</h3>
               @endif
            @endif

            @if(in_array($user['status'], [
                \App\Concerns\Enums\Status::PENDING_APPROVAL_DATA->value,
                \App\Concerns\Enums\Status::SEND_TO_CHANCELLERY->value,
                \App\Concerns\Enums\Status::FINISHED->value,
                \App\Concerns\Enums\Status::PENDING_CORRECT_DATA->value
            ]))
                <h3 class="text-white font-semibold text-2xl mb-3">Want to use our complimentary shuttle service?</h3>
                <p class="text-white">Don’t forget to let us know your travel and accommodation arrangements</p>
            @endif

            <div class="sm:flex hidden justify-center mt-5 space-x-6">
                @if(in_array($user['status'], [
                    \App\Concerns\Enums\Status::CONFIRMED->value
                ]))
                    <a href="{{$data['url']}}" class="btn btn-primary">{{$data['text_button']}}</a>
                @endif

                @if(in_array($user['status'], [
                    \App\Concerns\Enums\Status::FINISHED->value,
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
                    \App\Concerns\Enums\Status::FINISHED->value,
                    \App\Concerns\Enums\Status::PENDING_CORRECT_DATA->value
                ]))
                    <a href="{{route('hotel')}}" class="btn btn-primary">Complete flight and  booking accomodation</a>
                @endif
            </div>
        </div>
        <div class="col-span-4 flex sm:justify-start justify-center sm:py-0 py-3">
            <div>
                <div class="circular-progress" aria-valuenow="{{$progress}}" aria-valuemin="0" aria-valuemax="100" style="--value:{{$progress}}"></div>
                <div class="sm:hidden flex justify-center mt-5 space-x-6">
                    @if(in_array($user['status'], [
                        \App\Concerns\Enums\Status::CONFIRMED->value
                    ]))
                        <a href="{{$data['url']}}" class="btn btn-primary">{{$data['text_button']}}</a>
                    @endif

                    @if(in_array($user['status'], [
                        \App\Concerns\Enums\Status::FINISHED->value,
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
                        \App\Concerns\Enums\Status::FINISHED->value,
                        \App\Concerns\Enums\Status::PENDING_CORRECT_DATA->value
                    ]))
                        <a href="{{route('hotel')}}" class="btn btn-primary">Complete flight and  booking accomodation</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
