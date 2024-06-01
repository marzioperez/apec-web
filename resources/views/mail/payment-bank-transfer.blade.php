@extends('layouts.mail')
@section('content')

    <div style="height: 100%; border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px; text-align: center; padding-top: 10px; padding-bottom: 20px;">
        <img src="{{asset('img/header-email-3.png')}}" style="width: 100%;" alt="{{config('app.name')}}"/>
    </div>

    <div style="text-align: left; padding: 0 44px 44px;">
        <p style="font-size: 14px; margin-bottom: 10px;">Dear {{$user['name']}},</p>

        <p style="font-size: 14px;">We are pleased to inform you that your registration has been successfully processed.</p>

        <p style="font-size: 14px;">With the information provided, we will now validate your payment.Please expect to hear from us within two business days. Thank you for your patience and continued support.</p>

        <p style="font-size: 14px; margin-bottom: 30px;">Meanwhile, we inform you that you got access to new information in our website, including the accommodation alternatives and the option of sharing your flight details. If you would like to make use of our complimentary transfer service during the event, we highly encourage you to stay at one of the designated hotels and let us know your complete travel arrangements.</p>

        <div style="text-align: center; margin-bottom: 30px;">
            <a href="{{config('app.url')}}" target="_blank" style="color: #FFF; font-size: 14px; text-decoration: none; background-color: #75B42E; padding-bottom: 10px; padding-top: 10px; padding-left: 40px; padding-right: 40px; border-radius: 5px;">Go to home</a>
        </div>


        <p style="font-size: 14px; text-align: center">If you have any questions, feel free to contact us at <a href="mailto:registration@apecceosummit2024.com" style="color: #00A2F3;">registration@apecceosummit2024.com</a></p>

        <p style="font-size: 14px;">Warm regards,<br>
            The APEC CEO Summit 2024 Host Committee</p>
    </div>

@endsection
