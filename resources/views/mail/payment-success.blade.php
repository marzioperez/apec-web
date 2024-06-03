@extends('layouts.mail')
@section('content')

    <div style="height: 100%; border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px; text-align: center; padding-top: 10px; padding-bottom: 20px;">
        <img src="{{asset('img/header-email-3.png')}}" style="width: 100%;" alt="{{config('app.name')}}"/>
    </div>

    <div style="text-align: left; padding: 0 44px 44px;">
        <p style="font-size: 14px; margin-bottom: 10px;">Dear {{$user['name']}},</p>

        <p style="font-size: 14px;">We are delighted to inform you that your registration for the APEC CEO Summit 2024 has been successfully processed. Please remember to bring your passport to collect your badge before the event.</p>

        <p style="font-size: 14px; margin-bottom: 20px;">You now have access to new information in our website, including the accommodation options and the option of sharing your flight details. If you would like to make use of our complimentary transfer service during the event, we highly encourage you to stay at one of the designated hotels and let us know your complete travel arrangements.</p>

        <div style="text-align: center; margin-bottom: 30px;">
            <a href="{{route('hotel')}}" style="color: #FFF; font-size: 14px; text-decoration: none; background-color: #75B42E; padding-bottom: 10px; padding-top: 10px; padding-left: 40px; padding-right: 40px; border-radius: 5px;">Book hotel and share your flight</a>
        </div>

        <p style="font-size: 14px;">We will be in touch with you to share the latest updates on the event. For more information, please visit our event website.</p>

        <p style="font-size: 14px; margin-bottom: 20px;">If you have any questions, feel free to contact us at <a href="mailto:registration@apecceosummit2024.com" style="color: #00A2F3;">registration@apecceosummit2024.com</a>.</p>

        <p style="font-size: 14px;">Warm regards,<br>
            The APEC CEO Summit 2024 Host Committee</p>

    </div>

@endsection
