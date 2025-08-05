<footer style="width:100%;background:#222;color:#fff;padding:1.2rem 0 0.7rem 0;text-align:center;margin-top:auto;">
    <div style="max-width:1200px;margin:0 auto;font-size:1rem;padding:0 1rem;">
        &copy; {{ date('Y') }} Yoga Platform. All rights reserved.
        &nbsp;|&nbsp;
        <a href="{{ route('terms', ['lang' => app()->getLocale()]) }}" style="color:#9ddcff;text-decoration:underline;">Terms & Disclaimer</a>
    </div>
    <style>
        
        @media (max-width: 700px) {
                footer {
            margin-top: 10rem !important; /* Or 800px if necessary, but better to avoid such large static values */
        }
            footer div {
                font-size: 0.98rem;
                padding: 0 0.5rem;
            }
        }
        @media (max-width: 500px) {
            footer div {
                font-size: 0.95rem;
                padding: 0 0.2rem;
            }
        }
    </style>
</footer> 