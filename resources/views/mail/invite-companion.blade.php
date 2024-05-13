@extends('layouts.mail')
@section('content')

    <div style="text-align: left;">
        <p style="font-size: 14px; margin-bottom: 10px;">Dear {{$user['name']}},</p>

        <p style="font-size: 14px;">You are invite for {{$user['parent']['name']}}...</p>

        <p style="font-size: 14px; margin-bottom: 20px">To proceed with your registration, please log in using the following credentials:</p>

        <p style="font-size: 14px;"><b>Email:</b> {{$user['email']}}<br>
            <b>Password:</b> {{$user['code']}}</p>

        <p style="font-size: 14px; margin-bottom: 30px;">Upon logging in, you will find the registration and payment form, as well as information about the Summit agenda, venue, accommodation options, and other logistical aspects to assist with your planning.</p>

        <div style="text-align: center; margin-bottom: 30px;">
            <a href="{{route('login')}}" style="color: #FFF; font-size: 14px; text-decoration: none; background-color: #75B42E; padding-bottom: 10px; padding-top: 10px; padding-left: 40px; padding-right: 40px; border-radius: 5px;">Log in</a>
        </div>

        <p style="font-size: 14px; margin-bottom: 20px;">Should you have any questions or require additional information, please do not hesitate to contact us at <a href="mailto:registration@apecceosummit2024.com" style="color: #00A2F3;">registration@apecceosummit2024.com</a>.<br>
            Our team is dedicated to ensuring that you have all the support you need for a productive and enjoyable experience at the Summit.</p>

        <p style="font-size: 14px;">Sincerely,<br>
            The APEC CEO Summit 2024 Host Committee</p>
    </div>

@endsection
