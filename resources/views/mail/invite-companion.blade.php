@extends('layouts.mail')
@section('content')

    <div style="height: 100%; border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px; text-align: center; padding-top: 10px; padding-bottom: 20px;">
        <img src="{{asset('img/header-email-1.png')}}" style="width: 100%;" alt="{{config('app.name')}}"/>
    </div>

    <div style="text-align: left; padding: 0 44px 44px;">
        <p style="font-size: 14px; margin-bottom: 10px;">Dear {{$user['name']}},</p>

        <p style="font-size: 14px;">With great anticipation for the APEC CEO Summit 2024 in Lima, Peru, scheduled from November 13th to 15th, we recognize the invaluable role accompanying persons play in enhancing the delegate experience. It is our pleasure to extend this invitation to you, inviting you to join us and partake in the rich culture and heritage of Peru.</p>

        <p style="font-size: 14px;">As an accompanying person, you will have exclusive access to a tailored program designed to explore Lima's stunning landscapes, culinary delights, and rich historical treasures.</p>

        <p style="font-size: 14px;">This carefully crafted itinerary offers engaging experiences beyond the official sessions of the Summit, providing opportunities to connect with fellow attendees and indulge in the finest Peruvian hospitality. Additionally, you will have access to the official APEC CEO Summit social events.</p>

        <p style="font-size: 14px;">To proceed with your registration, please log in using the following credentials:</p>

        <p style="font-size: 14px; margin-bottom: 30px;"><b>Email:</b> {{$user['email']}}<br>
            <b>Password:</b> {{$user['phone']}}</p>

        <div style="text-align: center; margin-bottom: 30px;">
            <a href="{{route('login')}}" style="color: #FFF; font-size: 14px; text-decoration: none; background-color: #75B42E; padding-bottom: 10px; padding-top: 10px; padding-left: 40px; padding-right: 40px; border-radius: 5px;">Log in</a>
        </div>

        <p style="font-size: 14px; margin-bottom: 20px;">For any inquiries or additional information, please do not hesitate to contact us at <a href="mailto:registration@apecceosummit2024.com" style="color: #00A2F3;">registration@apecceosummit2024.com</a>.</p>

        <p style="font-size: 14px;">Best regards,<br>
            The APEC CEO Summit 2024</p>
    </div>

@endsection
