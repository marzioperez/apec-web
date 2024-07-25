@extends('layouts.mail')
@section('content')

    <div style="height: 100%; border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px; text-align: center; padding-top: 10px; padding-bottom: 20px;">
        <img src="{{asset('img/header-email-3.png')}}" style="width: 100%;" alt="{{config('app.name')}}"/>
    </div>

    <div style="text-align: left; padding: 0 44px 44px;">
        <p style="font-size: 14px; margin-bottom: 10px;">Dear {{$user['name']}},</p>

        <p style="font-size: 14px;">We have identified some issues in your registration form as the information provided does not meet our required standards. Please update the following details:</p>

        <div style="font-size: 14px; margin-bottom: 30px;">{!! $observation !!}</div>

        <div style="text-align: center; margin-bottom: 30px;">
            <a href="{{route('progress')}}" target="_blank" style="color: #FFF; font-size: 14px; text-decoration: none; background-color: #75B42E; padding-bottom: 10px; padding-top: 10px; padding-left: 40px; padding-right: 40px; border-radius: 5px;">Complete registration</a>
        </div>

        <p style="font-size: 14px;">Thank you for promptly addressing these changes. If you need any assistance, please do not hesitate to contact us.</p>

        <p style="font-size: 14px;">Sincerely,<br>
            The APEC CEO Summit 2024 Host Committee</p>
    </div>

@endsection
