@extends('layouts.mail')
@section('content')

    <div style="height: 100%; border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px; text-align: center; padding-top: 10px; padding-bottom: 20px;">
        <img src="{{asset('img/header-email-1.png')}}" style="width: 100%;" alt="{{config('app.name')}}"/>
    </div>

    <div style="text-align: left; padding: 0 44px 44px;">
        <p style="font-size: 14px;">Thank you for expressing your interest in attending the APEC CEO Summit 2024. We are thrilled that you are considering joining us at the most important business event in the Asia-Pacific region. Your expression of interest is now under review.For your records, a copy of your information is enclosed with this email.</p>
        <p style="font-size: 14px;">Our team is diligently working to ensure that the summit delivers an engaging, distinctive, and insightful experience for all participants. Kindly anticipate a subsequent email outlining the next steps in your registration process.</p>

        <p style="font-size: 14px; text-align: center">For more information, visit our event website. If you have any questions regarding registration, please contact us at <a href="mailto:registration@apecceosummit2024.com" style="color: #00A2F3;">registration@apecceosummit2024.com</a></p>
    </div>

@endsection
