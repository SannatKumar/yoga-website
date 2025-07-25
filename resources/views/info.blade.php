@extends('layouts.app')

@section('content')
    <style>
        .info-flex {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            max-width: 1000px;
            margin: 2rem auto 0 auto;
            justify-content: center;
            align-items: flex-start;
        }
        .cert-section {
            flex: 1 1 320px;
            min-width: 320px;
            max-width: 420px;
        }
        .teacher-profile {
            flex: 1 1 320px;
            min-width: 320px;
            max-width: 420px;
            padding: 1.2rem 1.2rem 1.5rem 1.2rem;
            background: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            text-align: center;
        }
        .teacher-profile img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 0.8rem;
            border: 3px solid #6c63ff;
        }
        .teacher-profile h2 {
            margin-bottom: 0.4rem;
            font-size: 1.5rem;
            color: #6c63ff;
        }
        .teacher-profile p {
            color: #444;
            font-size: 1rem;
            margin-bottom: 1rem;
        }
        .teacher-profile .contact-info {
            font-size: 0.98rem;
            color: #333;
        }
        .cert-section h2 {
            text-align: center;
            margin-bottom: 1rem;
            font-size: 1.3rem;
        }
        .cert-gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 0.7rem;
            justify-content: center;
        }
        .cert-thumb {
            width: 90px;
            height: 70px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid #ccc;
            cursor: pointer;
            transition: border-color 0.2s;
        }
        .cert-thumb:hover {
            border-color: #6c63ff;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0,0,0,0.6);
            justify-content: center;
            align-items: center;
        }
        .modal.active {
            display: flex;
        }
        .modal-content {
            background: #fff;
            padding: 1.5rem;
            border-radius: 10px;
            max-width: 90vw;
            max-height: 90vh;
            text-align: center;
            position: relative;
        }
        .modal-content img {
            max-width: 350px;
            width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 1rem;
        }
        .modal-content .close-btn {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: #6c63ff;
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            font-size: 1.2rem;
            cursor: pointer;
        }
        @media (max-width: 900px) {
            .info-flex {
                flex-direction: column;
                gap: 1.5rem;
                max-width: 98vw;
            }
            .cert-section, .teacher-profile {
                max-width: 98vw;
            }
        }
    </style>
    <div class="info-flex">
        <div class="cert-section">
            <h2>Certificates</h2>
            <div class="cert-gallery">
                @for ($i = 1; $i <= 7; $i++)
                    <img src="https://placehold.co/240x180?text=Certificate+{{ $i }}" class="cert-thumb" alt="Certificate {{ $i }}" onclick="showCert({{ $i }})">
                @endfor
            </div>
        </div>
        <div class="teacher-profile">
            <img src="/images/raj_profile_photo.jpg" alt="Lion Photo" />
            <h2>Raj Kumar</h2>
            <p>
                Raj Kumar is a passionate yoga teacher with over 1.5 years of experience in guiding students towards physical and mental well-being. Specializing in Hatha and Vinyasa yoga, Raj brings energy, wisdom, and a calming presence to every class.
            </p>
            <div class="contact-info">
                <div>Email: rajkumarmailuser@gmail.com</div>
                <!--<div>Instagram: @simha.yoga</div>-->
            </div>
        </div>
    </div>

    <div id="cert-modal" class="modal" onclick="closeCert(event)">
        <div class="modal-content" onclick="event.stopPropagation()">
            <button class="close-btn" onclick="closeCert(event)">&times;</button>
            <img id="modal-img" src="" alt="Certificate" />
            <div id="modal-desc" style="margin-top:1rem;"></div>
        </div>
    </div>

    <script>
        const certDescriptions = [
            '',
            'Certificate 1: 200-Hour Yoga Teacher Training, Yoga Alliance, 2015',
            'Certificate 2: Advanced Pranayama Workshop, 2016',
            'Certificate 3: Yoga Therapy Certification, 2017',
            'Certificate 4: Mindfulness & Meditation, 2018',
            'Certificate 5: Children\'s Yoga Instructor, 2019',
            'Certificate 6: Anatomy for Yoga, 2020',
            'Certificate 7: Senior Yoga Specialist, 2021'
        ];
        function showCert(idx) {
            document.getElementById('modal-img').src = `https://placehold.co/480x360?text=Certificate+${idx}`;
            document.getElementById('modal-desc').innerText = certDescriptions[idx];
            document.getElementById('cert-modal').classList.add('active');
        }
        function closeCert(e) {
            document.getElementById('cert-modal').classList.remove('active');
        }
    </script>
@endsection 