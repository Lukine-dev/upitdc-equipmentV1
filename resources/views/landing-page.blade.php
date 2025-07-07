@extends('layouts.app')

@section('title', 'UPITDC Rentals')

@section('content')
    <section class="parallax-section">
        <div class="parallax-overlay"></div>
        <div class="parallax-content" data-aos="fade-up">
            <h1>University of the Philippines</h1>
            <p class="lead">Unified Equipment Inventory and Request System</p>
            <a href="#about" class="btn btn-light btn-main mt-3">Get Started</a>
        </div>
    </section>

    <section id="about" class="section" data-aos="fade-right">
        <div class="container text-center">
            <h2 class="mb-4">📦 Rent Laptops, Projectors & More</h2>
            <p class="text-muted">
                This system allows UP constituents to rent ICT devices easily.
                View availability, submit a request, and track your rentals.
            </p>
        </div>
    </section>
@endsection
