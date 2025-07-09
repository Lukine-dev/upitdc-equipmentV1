@extends('layouts.app')

@section('title', 'UPITDC-UEIRS')

@section('content')
    <style>
        .section-img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .highlight {
            font-weight: bold;
            color: #004080;
        }

        .info-card {
            background-color: #f8f9fa;
            padding: 40px 20px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }
    </style>

    {{-- Hero Parallax Section --}}
    <section class="parallax-section">
        <div class="parallax-overlay"></div>
        <div class="parallax-content" data-aos="fade-up">
            <h1>University of the Philippines</h1>
            <p class="lead">Unified Equipment Inventory and Request System</p>
            <a href="#about" class="btn btn-light btn-main mt-3">Get Started</a>
        </div>
    </section>

    {{-- About Equipment Rental --}}
    <section id="about" class="section bg-light" data-aos="fade-right">
        <div class="container text-center">
            <h2 class="mb-4">📦 Rent Laptops, Projectors & More</h2>
            <p class="text-muted">
                This system allows UP constituents to rent ICT devices efficiently.
                View availability, submit rental requests, and manage your bookings online.
            </p>
            <img src="{{ asset('storage/Images/ict-rentals.jpg') }}" alt="ICT Rentals" class="section-img mt-4" />
        </div>
    </section>

    {{-- About UP --}}
    <section id="about-up" class="section" data-aos="fade-left">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 mb-4">
                    <img src="{{ asset('storage/Images/up-campus.jpg') }}" alt="UP Campus" class="section-img">
                </div>
                <div class="col-md-6">
                    <h3 class="highlight">The University of the Philippines</h3>
                    <p>
                        The <strong>University of the Philippines</strong> (UP) is the country’s national university.
                        With multiple campuses across the archipelago, UP is committed to excellence in education,
                        research, and public service.
                    </p>
                    <p>
                        UP's ICT infrastructure supports cutting-edge academic, scientific, and administrative services—
                        making systems like this equipment rental portal essential for efficient operations.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- About ITDC --}}
    <section id="about-itdc" class="section bg-light" data-aos="fade-up">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 order-md-2 mb-4">
                    <img src="{{ asset('storage/Images/itdc-team.jpg') }}" alt="ITDC Team" class="section-img">
                </div>
                <div class="col-md-6 order-md-1">
                    <h3 class="highlight">Information Technology Development Center (ITDC)</h3>
                    <p>
                        The <strong>UP ITDC</strong> plays a pivotal role in providing technology solutions for the university.
                        It manages digital infrastructure, enhances cybersecurity, and delivers systems for efficient resource management.
                    </p>
                    <p>
                        The Unified Equipment Inventory and Request System (UEIRS) is one of its many initiatives that ensure
                        accessible and transparent equipment rentals across all departments.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="text-center bg-dark text-white py-4">
        &copy; {{ now()->year }} University of the Philippines | Information Technology Development Center |
        Unified Equipment Inventory and Request System <br>
        &copy; {{ now()->year }} Justine Carl P. Mantua
    </footer>
@endsection
