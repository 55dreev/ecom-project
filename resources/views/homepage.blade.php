@extends('layouts.app')

@section('title', 'Home - T Shop')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>T Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
</head>

<!-- Hero Section -->
<div class="container text-center my-5">
    <h1><strong>Welcome</strong> to Suit Up</h1>
    <div class="highlight">Find Your Perfect Costume</div>
</div>

<!-- Product Grid -->
<div class="container">
    <div class="product-grid">
        <img src="{{ asset('images/girl.svg') }}" alt="Product 1" class="img-fluid">
        <img src="{{ asset('images/clothes.svg') }}" alt="Product 2" class="img-fluid">
        <img src="{{ asset('images/girl.svg') }}" alt="Product 3" class="img-fluid">
    </div>
</div>

<!-- Latest Additions -->
<div class="container mt-5">
    <h2 class="text-center mb-4 fw-bold">Latest Additions</h2>
    <div class="row g-3">
        @foreach($costumes as $costume)
            <div class="col-md-3">
                <div class="card h-100 d-flex flex-column border-0">
                    <a href="{{ route('product.show', ['id' => $costume->id]) }}">
                        <img src="{{ asset($costume->image) }}" class="card-img-top img-fluid" alt="{{ $costume->name }}" style="height: 350px; object-fit: cover;">
                    </a>
                    <div class="card-body text-center flex-grow-1">
                        <h6 class="card-title">{{ $costume->name }}</h6>
                        <p class="card-text">₱{{ number_format($costume->price, 2) }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
