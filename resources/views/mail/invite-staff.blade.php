@extends('layouts.mail')
@section('content')

    <div style="height: 100%; border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px; text-align: center; padding-top: 10px; padding-bottom: 20px;">
        <img src="{{asset('img/header-email-1.png')}}" style="width: 100%;" alt="{{config('app.name')}}"/>
    </div>

    <div style="text-align: left; padding: 0 44px 44px;">
        <p style="font-size: 14px; margin-bottom: 10px;">Dear {{$user['name']}},</p>

        <p style="font-size: 14px;">We understand the important role that staffers will play in enriching the overall experience for delegates at the upcoming APEC CEO Summit 2024. Therefore, we are delighted to invite you to join us!</p>

        <p style="font-size: 14px;">As a staffer, you will join one of our delegates in attending the Summit, providing vital assistance throughout the event. While there will be a different seating arrangement for staffers, you will have the opportunity to participate in the Summit's official sessions and social events, ensuring a comprehensive and engaging experience.</p>

        <p style="font-size: 14px;">To proceed with your registration, please log in using the following credentials:</p>

        <p style="font-size: 14px; margin-bottom: 30px;"><b>Email:</b> {{$user['email']}}<br>
            <b>Password:</b> {{$user['phone']}}</p>

        <div style="text-align: center; margin-bottom: 30px;">
            <a href="{{route('login')}}" style="color: #FFF; font-size: 14px; text-decoration: none; background-color: #75B42E; padding-bottom: 10px; padding-top: 10px; padding-left: 40px; padding-right: 40px; border-radius: 5px;">Log in</a>
        </div>

        <p style="font-size: 14px; margin-bottom: 10px;">For any inquiries or additional information, please do not hesitate to contact us at <a href="mailto:registration@apecceosummit2024.com" style="color: #00A2F3;">registration@apecceosummit2024.com</a>.</p>

        <p style="font-size: 14px; margin-bottom: 20px;">We look forward to welcoming you in Lima!</p>

        <p style="font-size: 14px;">Best regards,<br>
            The APEC CEO Summit 2024</p>
    </div>

@endsection
