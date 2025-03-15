@extends('layouts.headerfooter')

@section('title', 'Product Info')

@section('content')

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    
    <!-- Bootstrap CSS (Load first) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <!-- Tailwind CSS (Load after Bootstrap) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">

    <!-- Custom CSS (Last to allow overrides) -->
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
            <form action="#" method="POST" class="mt-2">
                <div class="flex items-center space-x-2">
                    <div>
                        <label for="quantity" class="block text-sm font-medium text-gray-600">Quantity</label>
                        <input type="number" id="quantity" name="quantity" value="1" min="1" class="w-14 p-1 border rounded-md" oninput="updateTotalPrice()">
                    </div>
                    <div>
                        <label for="days" class="block text-sm font-medium text-gray-600">Days to Rent</label>
                        <input type="number" id="days" name="days" value="1" min="1" class="w-14 p-1 border rounded-md" oninput="updateTotalPrice()">
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

    <!-- Display Existing Reviews -->
    <div class="bg-white p-6 rounded-lg shadow-md mt-6">
        <h2 class="text-xl font-semibold mb-4">Customer Reviews</h2>
        @if($reviews->isEmpty())
    <p>No reviews yet. Be the first to review!</p>
@else
    @foreach($reviews as $review)
        <div class="review">
            <strong>{{ $review->name }}</strong> 
            <span>Rating: {{ $review->rating }}/5</span>
            <p>{{ $review->comment }}</p>
            <small>Posted on {{ $review->created_at->format('M d, Y') }}</small>

            {{-- Display Replies --}}
            @if($review->replies->isNotEmpty())
                <div class="replies">
                    @foreach($review->replies as $reply)
                        <div class="reply">
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
        <form action="{{ route('reviews.store') }}" method="POST">
        @csrf
        <input type="hidden" name="parent_id" value="{{ $costume->id }}">
        <div>
                <label class="block text-sm font-medium text-gray-600">Your Name</label>
                <input type="text" name="name" class="w-full p-3 border rounded-md" required>
            </div>
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
            <input type="hidden" name="costume_id" value={{ $costume->id }}>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md mt-4">Submit Review</button>
        </form>
    </div>
</div>

<script>
    function toggleReplyForm(id) {
        let form = document.getElementById('reply-form-' + id);
        if (form) {
            form.classList.toggle('hidden');
        }
    }
    function updateTotalPrice() {
        let pricePerDay = {{ $costume->price }};
        let quantity = document.getElementById("quantity").value;
        let days = document.getElementById("days").value;
        let totalPrice = pricePerDay * quantity * days;
        document.getElementById("total-price").innerText = totalPrice.toFixed(2);
    }
</script>
</body>
@endsection