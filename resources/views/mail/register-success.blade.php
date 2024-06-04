@extends('layouts.mail')
@section('content')

    <div style="height: 100%; border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px; text-align: center; padding-top: 10px; padding-bottom: 20px;">
        <img src="{{asset('img/header-email-1.png')}}" style="width: 100%;" alt="{{config('app.name')}}"/>
    </div>

    <div style="text-align: left; padding: 0 44px 44px;">
        <p style="font-size: 14px; margin-bottom: 10px;">Dear {{$user['name']}},</p>

        <p style="font-size: 14px;">We are pleased to inform you that you have been accepted to attend the APEC CEO Summit 2024.</p>

        <p style="font-size: 14px;">The Summit, to take place from November 13 to 15, will be a great opportunity to connect with peers, explore innovative ideas, and form strategic partnerships.</p>

        <p style="font-size: 14px; margin-bottom: 20px">To complete your registration, please visit our website and log in using the following credentials:</p>

        <p style="font-size: 14px;"><b>Email:</b> {{$user['email']}}<br>
        <b>Password:</b> {{$password}}</p>

        <p style="font-size: 14px; margin-bottom: 30px;">Once logged in, you will find the registration and payment forms, as well as more details about the agenda, venue, accommodation options, and other logistic arrangements.</p>

        <div style="text-align: center; margin-bottom: 30px;">
            <a href="{{route('login')}}" style="color: #FFF; font-size: 14px; text-decoration: none; background-color: #75B42E; padding-bottom: 10px; padding-top: 10px; padding-left: 40px; padding-right: 40px; border-radius: 5px;">Log in</a>
        </div>

        <p style="font-size: 14px; margin-bottom: 10px;">If you have any questions or need additional information, please get in touch with us at <a href="mailto:registration@apecceosummit2024.com" style="color: #00A2F3;">registration@apecceosummit2024.com</a>.<p>

        <p style="font-size: 14px; margin-bottom: 10px;">We are here to ensure you have a productive and enjoyable experience at the Summit.</p>

        <p style="font-size: 14px;">Yours sincerely,<br>
            The APEC CEO Summit 2024 Host Committee</p>
    </div>

@endsection
