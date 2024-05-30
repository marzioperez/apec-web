@extends('layouts.mail')
@section('content')

    <div style="height: 100%; border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px; text-align: center; padding-top: 10px; padding-bottom: 20px;">
        <img src="{{asset('img/header-email-5.png')}}" style="width: 100%;" alt="{{config('app.name')}}"/>
    </div>

    <div style="text-align: left; padding: 0 44px 44px;">
        <p style="font-size: 14px; margin-bottom: 10px;">Dear {{$user['name']}},</p>

        <p style="font-size: 14px;">To ensure a seamless experience upon your arrival in Lima, Peru, we are pleased to extend an offer for personalized transfers and accompaniment during your stay.</p>

        <p style="font-size: 14px; margin-bottom: 20px">If you would like to make use of these services, we kindly request that you provide your flight and accommodation details via the following link:</p>

        <p style="font-size: 14px;"><b>Email:</b> {{$user['email']}}<br>
            <b>Password:</b> {{$user['phone']}}</p>

        <p style="font-size: 14px; margin-bottom: 30px;">Upon logging in, you will find the registration and payment form, as well as information about the Summit agenda, venue, accommodation options, and other logistical aspects to assist with your planning.</p>

        <div style="text-align: center; margin-bottom: 30px;">
            <a href="{{route('hotel')}}" style="color: #FFF; font-size: 14px; text-decoration: none; background-color: #75B42E; padding-bottom: 10px; padding-top: 10px; padding-left: 40px; padding-right: 40px; border-radius: 5px;">Go to profile</a>
        </div>

        <p style="font-size: 14px; margin-bottom: 20px;">You may complete the required information until October 10, 2024.</p>

        <p style="font-size: 14px; text-align: center">For more information, visit our event website. If you have any questions regarding registration, please contact us at <a href="mailto:registration@apecceosummit2024.com" style="color: #00A2F3;">registration@apecceosummit2024.com</a></p>
    </div>

@endsection
