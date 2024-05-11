@extends('layouts.mail')
@section('content')

    <div style="text-align: left;">
        <p style="font-size: 14px; margin-bottom: 10px;">Dear {{$user['name']}},</p>

        <p style="font-size: 14px;">We extend our sincere gratitude for your interest in participating in the APEC CEO Summit 2024. The overwhelming response we received from individuals worldwide underscores the profound enthusiasm and dedication within our community.<br>
            Following a meticulous review process of all submissions, it is with regret that we must inform you of our inability to accommodate your attendance at this year's Summit.<br>
            The selection process was exceptionally competitive, and despite recognizing the merit and potential contributions of each applicant, we faced the challenge of limited capacity, compelling us to make difficult decisions.</p>

        <p style="font-size: 14px;">We genuinely appreciate your understanding of this circumstance and hope that this outcome will not diminish your enthusiasm for engaging in business endeavors across the APEC region. Furthermore, we eagerly anticipate the possibility of welcoming you to future APEC events and maintaining our connection through alternative platforms and initiatives.</p>

        <p style="font-size: 14px;">Thank you once again for your keen interest in the APEC CEO Summit 2024. We extend our best wishes for your continued success, and we remain hopeful for the opportunity to engage with you in the future. Warm regards, The APEC CEO Summit 2024 Host Committee</p>
    </div>

@endsection
