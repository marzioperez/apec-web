@extends('layouts.mail')
@section('content')

    <div style="height: 100%; border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px; text-align: center; padding-top: 10px; padding-bottom: 20px;">
        <img src="{{asset('img/header-email-3.png')}}" style="width: 100%;" alt="{{config('app.name')}}"/>
    </div>

    <div style="text-align: left; padding: 0 44px 44px;">
        <p style="font-size: 14px; margin-bottom: 10px;">Dear {{$user['name']}},</p>

        <p style="font-size: 14px;">We have identified an issue with the specifications of the photo you provided in our system. Kindly respond to this email with a replacement.</p>

        <div style="font-size: 14px; margin-bottom: 30px;">{!! $observation !!}</div>

        <div style="text-align: center; margin-bottom: 30px;">
            <a href="{{route('progress')}}" target="_blank" style="color: #FFF; font-size: 14px; text-decoration: none; background-color: #75B42E; padding-bottom: 10px; padding-top: 10px; padding-left: 40px; padding-right: 40px; border-radius: 5px;">Complete registration</a>
        </div>

        <p style="font-size: 14px; text-align: center">For more information you can visit us on the event <a href="{{config('app.url')}}" target="_blank" style="color: #00A2F3;">website</a>.
            <br>Any questions write to us at: <a href="mailto:info@apecceosummit2024.com" style="color: #00A2F3;">info@apecceosummit2024.com</a></p>
    </div>

@endsection
