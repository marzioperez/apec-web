@extends('layouts.mail')
@section('content')

    <div style="height: 100%; border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px; text-align: center; padding-top: 10px; padding-bottom: 20px;">
        <img src="{{asset('img/header-email-1.png')}}" style="width: 100%;" alt="{{config('app.name')}}"/>
    </div>

    <div style="text-align: left; padding: 0 44px 44px;">
        <p style="font-size: 14px;">Thank you for expressing your interest in attending the APEC CEO Summit 2024. We are thrilled that you are considering joining us at the most important business event in the Asia-Pacific region. Your expression of interest is now under review. For your records, a copy of your information is enclosed with this email.</p>
        <p style="font-size: 14px;">Our team is diligently working to ensure that the summit delivers an engaging, distinctive, and insightful experience for all participants. Kindly anticipate a subsequent email outlining the next steps in your registration process.</p>

        <p style="font-size: 14px; text-align: center">For more information, visit our event website. If you have any questions regarding registration, please contact us at <a href="mailto:registration@apecceosummit2024.com" style="color: #00A2F3;">registration@apecceosummit2024.com</a></p>

        <p style="font-size: 14px; margin-bottom: 10px; text-decoration: underline; margin-top: 40px;"><b>Copy of your Expression of Interest</b></p>
        <p style="font-size: 14px; margin-bottom: 0;"><b>Name:</b> {{$user['name']}}</p>
        <p style="font-size: 14px; margin-bottom: 0; margin-top: 0;"><b>Last Name(s):</b> {{$user['last_name']}}</p>
        <p style="font-size: 14px; margin-bottom: 0; margin-top: 0;"><b>Company/Organization:</b> {{$user['business']}}</p>
        <p style="font-size: 14px; margin-bottom: 0; margin-top: 0;"><b>Company/Organization description:</b> {{$user['business_description']}}</p>
        <p style="font-size: 14px; margin-bottom: 0; margin-top: 0;"><b>Economy:</b> {{($user['economy'] === 'other' ? $user['other_economy'] : $user->rel_economy['name'])}}</p>
        <p style="font-size: 14px; margin-bottom: 0; margin-top: 0;"><b>Position:</b> {{$user['role']}}</p>
        <p style="font-size: 14px; margin-bottom: 0; margin-top: 0;"><b>Short bio:</b> {{$user['biography']}}</p>
        <p style="font-size: 14px; margin-bottom: 0; margin-top: 0;"><b>Email:</b> {{$user['email']}}</p>
        <p style="font-size: 14px; margin-bottom: 15px; margin-top: 0;"><b>Phone Number:</b> {{$user['phone']}}</p>

        <p style="font-size: 14px; margin-bottom: 5px;"><b>Participant's information:</b></p>
        <p style="font-size: 14px; margin-bottom: 0; margin-top: 0;"><b>Assistant's Name:</b> {{$user['attendee_name']}}</p>
        <p style="font-size: 14px; margin-bottom: 0; margin-top: 0;"><b>Assistant's Email:</b> {{$user['attendee_email']}}</p>
    </div>

@endsection
