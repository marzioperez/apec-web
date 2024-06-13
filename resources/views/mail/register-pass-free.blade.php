@extends('layouts.mail')
@section('content')

    <div style="height: 100%; border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px; text-align: center; padding-top: 10px; padding-bottom: 20px;">
        <img src="{{asset('img/header-email-1.png')}}" style="width: 100%;" alt="{{config('app.name')}}"/>
    </div>

    <div style="text-align: left; padding: 0 44px 44px;">
        <p style="font-size: 14px; margin-bottom: 10px;">Dear {{$user['name']}},</p>

        <p style="font-size: 14px;">We are delighted to inform you that you have been invited to attend the APEC CEO Summit 2024, the premier business event in the Asia-Pacific.</p>

        <p style="font-size: 14px;">This year's Summit, taking place in Lima, Peru, from November 13<sup>th</sup> to 15<sup>th</sup>, promises to be an insightful gathering of global leaders from business, government, and academia, converging to discuss pivotal issues shaping the Asia-Pacific region and beyond.</p>

        <p style="font-size: 14px;">The Summit will offer a unique platform for you to connect with peers, explore innovative ideas, and foster strategic partnerships.</p>

        <p style="font-size: 14px; margin-bottom: 20px">To proceed with your registration, please log in using the following credentials:</p>

        <p style="font-size: 14px;"><b>Email:</b> {{$user['email']}}<br>
        <b>Password:</b> {{$password}}</p>

        <div style="text-align: center; margin-bottom: 30px;">
            <a href="{{route('login')}}" style="color: #FFF; font-size: 14px; text-decoration: none; background-color: #75B42E; padding-bottom: 10px; padding-top: 10px; padding-left: 40px; padding-right: 40px; border-radius: 5px;">Log in</a>
        </div>

        <p style="font-size: 14px;">Upon logging in, you will access the registration system. Once your registration is complete and paid, you'll also get access to the information about the Summit agenda, venue, accommodation options, and other logistical aspects to assist with your planning.</p>

        <p style="font-size: 14px;">Should you have any questions or require additional information, please do not hesitate to contact us at <a href="mailto:registration@apecceosummit2024.com" style="color: #00A2F3;">registration@apecceosummit2024.com</a>.</p>

        <p style="font-size: 14px; margin-bottom: 20px;">Our team is dedicated to ensuring that you have all the support you need for a productive and enjoyable experience at the Summit.</p>

        <p style="font-size: 14px;">Sincerely<br>
            The APEC CEO Summit 2024 Host Committee</p>
    </div>

@endsection
