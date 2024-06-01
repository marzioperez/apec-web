@extends('layouts.mail')
@section('content')

    <div style="height: 100%; border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px; text-align: center; padding-top: 10px; padding-bottom: 20px;">
        <img src="{{asset('img/header-email-3.png')}}" style="width: 100%;" alt="{{config('app.name')}}"/>
    </div>

    <div style="text-align: left; padding: 0 44px 44px;">
        <p style="font-size: 14px; margin-bottom: 10px;">Dear {{$user['name']}},</p>

        <p style="font-size: 14px;">Thank you so much for your interest in the APEC CEO Summit 2024. We've been thrilled by the enthusiastic response from around the world.</p>

        <p style="font-size: 14px;">After careful consideration, we regret to inform you that we cannot secure a spot for you this year due to limited capacity and the high volume of exceptional applicants.</p>

        <p style="font-size: 14px;">We truly appreciate your understanding and hope this doesn't dampen your enthusiasm for future APEC events. We look forward to possible opportunities to connect with you in the future.</p>

        <p style="font-size: 14px;">Wishing you all the best and continued success.</p>

        <p style="font-size: 14px;">Warm regards,<br>
            The APEC CEO Summit 2024 Host Committee</p>
    </div>

@endsection
