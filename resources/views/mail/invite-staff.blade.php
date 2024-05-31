@extends('layouts.mail')
@section('content')

    <div style="height: 100%; border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px; text-align: center; padding-top: 10px; padding-bottom: 20px;">
        <img src="{{asset('img/header-email-1.png')}}" style="width: 100%;" alt="{{config('app.name')}}"/>
    </div>

    <div style="text-align: left; padding: 0 44px 44px;">
        <p style="font-size: 14px; margin-bottom: 10px;">Dear {{$user['name']}},</p>

        <p style="font-size: 14px;">With the APEC CEO Summit 2024 swiftly approaching, scheduled to take place in Lima, Peru, from November 13th to 15th, we understand the essential role that staffers play in providing support to our distinguished delegates throughout this significant event. It is with great pleasure that we extend this invitation to you to register as a staffer, allowing you to actively engage alongside your delegates during the Summit’s proceedings.</p>

        <p style="font-size: 14px;">As a staffer, you will have the opportunity to actively participate in the Summit by assisting in various sessions and participating in networking events that facilitate connections with leaders and experts from across the Asia-Pacific region.</p>

        <p style="font-size: 14px;">To proceed with your registration, please log in using the following credentials:</p>

        <p style="font-size: 14px; margin-bottom: 30px;"><b>Email:</b> {{$user['email']}}<br>
            <b>Password:</b> {{$user['phone']}}</p>

        <div style="text-align: center; margin-bottom: 30px;">
            <a href="{{route('login')}}" style="color: #FFF; font-size: 14px; text-decoration: none; background-color: #75B42E; padding-bottom: 10px; padding-top: 10px; padding-left: 40px; padding-right: 40px; border-radius: 5px;">Log in</a>
        </div>

        <p style="font-size: 14px; margin-bottom: 20px;">For any inquiries or additional information, please do not hesitate to contact us at <a href="mailto:registration@apecceosummit2024.com" style="color: #00A2F3;">registration@apecceosummit2024.com</a>.</p>

        <p style="font-size: 14px;">Best regards,<br>
            The APEC CEO Summit 2024</p>
    </div>

@endsection
