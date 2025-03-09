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
        @php
            $products = [
                ['id' => 1, 'name' => 'Classic Witch Costume', 'image' => 'gown.svg', 'price' => '75.00'],
                ['id' => 2, 'name' => 'Skeleton Gloves', 'image' => 'glove.jpg', 'price' => '18.00'],
                ['id' => 3, 'name' => 'Retro Sunglasses', 'image' => 'glasses.png', 'price' => '20.00'],
                ['id' => 4, 'name' => 'Zombie Makeup Kit', 'image' => 'makeup.png', 'price' => '40.00'],
                ['id' => 5, 'name' => 'Zombie Makeup Kit', 'image' => 'makeup.png', 'price' => '40.00'],
                ['id' => 6, 'name' => 'Zombie Makeup Kit', 'image' => 'makeup.png', 'price' => '40.00'],
                ['id' => 7, 'name' => 'Zombie Makeup Kit', 'image' => 'makeup.png', 'price' => '40.00'],
                ['id' => 8, 'name' => 'Zombie Makeup Kit', 'image' => 'makeup.png', 'price' => '40.00'],
            ];
        @endphp

        @foreach($products as $product)
            <div class="col-md-3">
                <div class="card h-100 d-flex flex-column border-0">
                    <a href="{{ route('product.show', ['id' => $product['id']]) }}">
                        <img src="{{ asset('images/' . $product['image']) }}" class="card-img-top img-fluid" alt="{{ $product['name'] }}" style="height: 350px; object-fit: cover;">
                    </a>
                    <div class="card-body text-center flex-grow-1">
                        <h6 class="card-title">{{ $product['name'] }}</h6>
                        <p class="card-text">${{ $product['price'] }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
