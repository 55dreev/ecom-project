@extends('layouts.headerfooter')

@section('title', 'About Us')

@section('content')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About Us - T Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/aboutus.css') }}">
</head>

<body>
    <div class="container text-center mt-5">
        <h1 class="fw-bold">About <span class="text-primary">Suit Up</span></h1>
        <p class="lead">Your one-stop shop for high-quality costumes, designed to make every occasion special.</p>
    </div>

    <div class="container mt-4">
        <div class="row align-items-center">
            <div class="col-md-6">
                <img src="{{ asset('images/about-us.svg') }}" alt="About Us Image" class="img-fluid">
            </div>
            <div class="col-md-6">
                <h3>Who We Are</h3>
                <p>Suit Up is dedicated to providing a wide range of costumes for every occasion. Whether you need a stylish outfit for a party or a unique costume for an event, we've got you covered.</p>
                
                <h3>Our Mission</h3>
                <p>We aim to deliver high-quality, affordable, and creative costumes that help you express yourself with confidence.</p>
                
                <h3>Why Choose Us?</h3>
                <ul>
                    <li>Wide selection of costumes for all occasions</li>
                    <li>Affordable and high-quality materials</li>
                    <li>Fast and reliable booking process</li>
                    <li>Exceptional customer service</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container text-center mt-5">
        <a href="{{ route('bookingform') }}" class="btn btn-primary">Book a Costume</a>
        <a href="{{ route('categories') }}" class="btn btn-secondary">Browse Categories</a>
    </div>
</body>

@endsection
