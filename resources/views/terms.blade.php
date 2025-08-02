@extends('layouts.app') {{-- Or your base layout --}}

@section('title', 'Terms & Disclaimer')

@section('content')
<div style="max-width: 800px; margin: 2rem auto; padding: 2rem; background: #f9fafb; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
    <h1 style="font-size: 1.75rem; margin-bottom: 1rem;">🧘 Terms of Use & Practice Disclaimer</h1>

    <p>Welcome to our yoga platform. By accessing or using this site, you agree to the following:</p>

    <h2 style="margin-top: 1.5rem;">1. Personal Data</h2>
    <ul style="padding-left: 1.2rem;">
        <li>We collect your IP address to count visits and unique users.</li>
        <li>Email addresses are only collected if you register or subscribe.</li>
        <li>We do not share or sell your information.</li>
    </ul>

    <h2 style="margin-top: 1.5rem;">2. Practice Responsibility</h2>
    <p>
        The yoga practices and content provided here are for informational and educational purposes only. 
        Physical activities like yoga may not be suitable for everyone.
    </p>
    <p>
        <strong>You are strongly advised to consult a qualified yoga teacher (guru) or healthcare provider before beginning any new practice.</strong>
    </p>

    <h2 style="margin-top: 1.5rem;">3. No Medical Advice</h2>
    <p>
        This website does not offer medical advice or treatment. You are responsible for your own health and safety while practicing.
    </p>

    <p style="margin-top: 2rem;">
        🙏 Thank you for your understanding. Practice safely and with awareness.
    </p>
</div>
@endsection
