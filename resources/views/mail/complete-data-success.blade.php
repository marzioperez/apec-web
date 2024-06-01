@extends('layouts.mail')
@section('content')

    <div style="height: 100%; border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px; text-align: center; padding-top: 10px; padding-bottom: 20px;">
        <img src="{{asset('img/header-email-3.png')}}" style="width: 100%;" alt="{{config('app.name')}}"/>
    </div>

    <div style="text-align: left; padding: 0 44px 44px;">
        <p style="font-size: 14px; margin-bottom: 10px;">Dear {{$user['name']}},</p>

        <p style="font-size: 14px;">We are delighted to inform you that your registration for the APEC CEO Summit 2024 has been successfully validated and all your information is complete.</p>

        <p style="font-size: 14px; margin-bottom: 30px;">Attached to this email, you will find a QR code that we recommend to bring with you to speed up the badge collection process.</p>

        <div style="text-align: center; margin-bottom: 30px;">
            <div>
                <img src="{{ config('app.url') . "/storage/qrs/{$user['qr']}" }}" style="border-radius: 5px; width: 150px; margin-bottom: 15px;" />
            </div>
            <a href="{{config('app.url')}}" target="_blank" style="color: #FFF; font-size: 14px; text-decoration: none; background-color: #75B42E; padding-bottom: 10px; padding-top: 10px; padding-left: 40px; padding-right: 40px; border-radius: 5px;">Go to home</a>
        </div>

        <p style="font-size: 14px; text-align: center; margin-bottom: 20px;">For more information you can visit us on the event <a href="{{config('app.url')}}" target="_blank" style="color: #00A2F3;">website</a>.
            <br>If you have any questions, feel free to contact us at <a href="mailto:registration@apecceosummit2024.com" style="color: #00A2F3;">registration@apecceosummit2024.com</a></p>

        <p style="font-size: 14px;">Best regards,<br>
            The APEC CEO Summit 2024 Host Committee</p>
    </div>

@endsection
