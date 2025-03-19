@extends('layouts.headerfooter')

@section('title', 'Product Info')

@section('content')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Product Page</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <!-- Tailwind CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
</head>

<body class="bg-gray-100">

<div class="max-w-4xl mx-auto p-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-white p-6 rounded-lg shadow-lg">
        <!-- Product Image -->
        <div>
            <img src="{{ asset($costume->image) }}" alt="{{ $costume->name }}" class="card-img-top img-fluid w-100">
        </div>

        <!-- Product Details -->
        <div>
            <h1 class="text-2xl font-bold">{{ $costume->name }}</h1>
            <p class="text-xl font-semibold mt-2">₱<span id="total-price">{{ number_format($costume->price, 2) }}</span></p>

            <!-- Quantity and Rental Duration Selector -->
            <form id="add-to-cart-form" action="{{ route('cart.add', ['id' => $costume->id]) }}" method="POST" class="mt-2">
                @csrf
                <div class="flex items-center space-x-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Quantity</label>
                        <input type="number" id="quantity" name="quantity" value="1" min="1" class="w-14 p-1 border rounded-md">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Days to Rent</label>
                        <input type="number" id="days" name="days" value="1" min="1" class="w-14 p-1 border rounded-md">
                    </div>
                </div>

                <button type="submit" class="bg-yellow-500 text-white px-3 py-1 rounded-md mt-2">Add to Cart</button>
            </form>

            <!-- Product Info -->
            <div class="mt-4">
                <h2 class="text-lg font-semibold">Product Info</h2>
                <p class="text-gray-600">{{ $costume->description }}</p>
            </div>
        </div>
    </div>
</div>

<div class="max-w-8xl mx-auto p-6">
    <h2 class="text-xl font-semibold mt-8">Customer Reviews</h2>

    <!-- Display Average Rating -->
    <div class="bg-white p-6 rounded-lg shadow-md mt-4 text-center">
        <h2 class="text-xl font-semibold">Average Rating</h2>
        @if(isset($averageRating) && $averageRating > 0)
            <p class="text-yellow-500 text-2xl">
                @for ($i = 1; $i <= 5; $i++)
                    @if($i <= round($averageRating))
                        ★
                    @else
                        ☆
                    @endif
                @endfor
                <span class="text-gray-600">({{ number_format($averageRating, 1) }}/5)</span>
            </p>
        @else
            <p class="text-gray-600">No ratings yet.</p>
        @endif
    </div>

    <!-- Display Reviews -->
    <div class="bg-white p-6 rounded-lg shadow-md mt-6">
        <h2 class="text-xl font-semibold mb-4">Customer Reviews</h2>
        @if($reviews->isEmpty())
            <p>No reviews yet. Be the first to review!</p>
        @else
            @foreach($reviews as $review)
                <div class="review border-b border-gray-300 pb-4 mb-4">
                    <strong>{{ $review->name }}</strong> 
                    
                    <!-- Star Rating Display -->
                    <p class="text-yellow-500 text-lg">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $review->rating)
                                ★
                            @else
                                ☆
                            @endif
                        @endfor
                        <span class="text-gray-600">({{ number_format($review->rating, 1) }}/5)</span>
                    </p>

                    <p>{{ $review->comment }}</p>
                    <small>Posted on {{ $review->created_at->format('M d, Y') }}</small>

                    <!-- Replies -->
                    @if($review->replies->isNotEmpty())
                        <div class="replies mt-3 pl-4 border-l border-gray-300">
                            @foreach($review->replies as $reply)
                                <div class="reply mb-2">
                                    <strong>{{ $reply->name }}</strong>
                                    <p>{{ $reply->comment }}</p>
                                    <small>Posted on {{ $reply->created_at->format('M d, Y') }}</small>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
        @endif
    </div>

    <!-- Review Submission Form -->
    <div class="bg-white p-6 rounded-lg shadow-md mt-6">
        <h3 class="text-lg font-semibold">Leave a Review</h3>
        @auth
            <form action="{{ route('reviews.store') }}" method="POST">
                @csrf
                <input type="hidden" name="costume_id" value="{{ $costume->id }}">
                <input type="hidden" name="name" value="{{ Auth::user()->name }}">

                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-600">Your Rating</label>
                    <select name="rating" class="w-full p-3 border rounded-md" required>
                        <option value="5">⭐⭐⭐⭐⭐ - Excellent</option>
                        <option value="4">⭐⭐⭐⭐ - Very Good</option>
                        <option value="3">⭐⭐⭐ - Good</option>
                        <option value="2">⭐⭐ - Fair</option>
                        <option value="1">⭐ - Poor</option>
                    </select>
                </div>

                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-600">Your Review</label>
                    <textarea name="comment" class="w-full p-3 border rounded-md" required></textarea>
                </div>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md mt-4">
                    Submit Review
                </button>
            </form>
        @else
            <p class="text-red-500">You must be logged in to leave a review. 
                <a href="{{ route('login') }}" class="text-blue-500">Login here</a>
            </p>
        @endauth
    </div>
</div>

</body>
@endsection
