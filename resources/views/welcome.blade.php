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

<div class="container mx-auto p-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-white p-6 rounded-lg shadow-lg">
        <!-- Product Image -->
        <div>
            <img src="clothes.svg" alt="Product Name" class="w-full rounded-lg shadow-md">
        </div>
        
        <!-- Product Details -->
        <div>
            <h1 class="text-2xl font-bold">Pirate Costume</h1>
            <p class="text-xl font-semibold mt-2">₱<span id="total-price">150.00</span></p>
            
            <!-- Quantity and Rental Duration Selector -->
            <form action="#" method="POST" class="mt-4">
                <div class="flex items-center space-x-4">
                    <div>
                        <label for="quantity" class="block text-sm font-medium text-gray-600">Quantity</label>
                        <input type="number" id="quantity" name="quantity" value="1" min="1" class="w-16 p-2 border rounded-md" oninput="updateTotalPrice()">
                    </div>
                    <div>
                        <label for="days" class="block text-sm font-medium text-gray-600">Days to Rent</label>
                        <input type="number" id="days" name="days" value="1" min="1" class="w-16 p-2 border rounded-md" oninput="updateTotalPrice()">
                    </div>
                </div>
                
                <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded-md mt-2">Add to Cart</button>
            </form>
            
            <!-- Product Info -->
            <div class="mt-6">
                <h2 class="text-lg font-semibold">Product Info</h2>
                <p class="text-gray-600">Set sail for adventure with this premium pirate costume! Made from high-quality, breathable fabric, this outfit is designed for comfort and style. The set includes:

A rugged pirate shirt with lace-up detailing
A faux-leather vest for an authentic buccaneer look
Striped pants with an adjustable waistband
A classic pirate hat with a skull emblem
A waist sash and belt for a complete look
Material: Polyester & Cotton Blend
Care Instructions: Hand wash only, do not bleach, line dry
Features: Lightweight, durable, and perfect for themed parties, Halloween, and cosplay events.</p>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    <h2 class="text-xl font-semibold mt-8">You Might Also Like</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4">
        <div class="border p-4 rounded-lg text-center bg-white shadow-md">
            <img src="clothes.svg" class="w-full h-32 object-cover rounded-md">
            <h3 class="mt-2 font-semibold">Pirate Cap</h3>
            <p class="text-gray-600">₱100.00</p>
            <a href="#" class="text-blue-500">View</a>
        </div>
        <div class="border p-4 rounded-lg text-center bg-white shadow-md">
            <img src="clothes.svg" class="w-full h-32 object-cover rounded-md">
            <h3 class="mt-2 font-semibold">Pirate Boots</h3>
            <p class="text-gray-600">₱150.00</p>
            <a href="#" class="text-blue-500">View</a>
        </div>
        <div class="border p-4 rounded-lg text-center bg-white shadow-md">
            <img src="clothes.svg" class="w-full h-32 object-cover rounded-md">
            <h3 class="mt-2 font-semibold">Pirate beard</h3>
            <p class="text-gray-600">₱50.00</p>
            <a href="#" class="text-blue-500">View</a>
        </div>
        <div class="border p-4 rounded-lg text-center bg-white shadow-md">
            <img src="clothes.svg" class="w-full h-32 object-cover rounded-md">
            <h3 class="mt-2 font-semibold">Pirate Bag</h3>
            <p class="text-gray-600">₱100.00</p>
            <a href="#" class="text-blue-500">View</a>
        </div>
    </div>

    <h2 class="text-xl font-semibold mt-8">Customer Reviews</h2>
    
    <!-- Display Average Rating -->
<div class="bg-white p-4 rounded-lg shadow-md mt-4 text-center">
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
<div class="bg-white p-4 rounded-lg shadow-md mt-4">
    <h2 class="text-xl font-semibold mb-4">Customer Reviews</h2>

    @if(isset($reviews) && $reviews->count())
        @foreach ($reviews as $review)
            <div class="border-b pb-2 mb-2">
                <p><strong>{{ $review->name }}</strong> 
                    <span class="text-gray-500 text-sm">({{ $review->created_at->format('M d, Y') }})</span>
                </p>
                
                <!-- Display Star Rating -->
                <p class="text-yellow-500">
                    @for ($i = 1; $i <= 5; $i++)
                        @if($i <= $review->rating)
                            ★
                        @else
                            ☆
                        @endif
                    @endfor
                    <span class="text-gray-500">({{ $review->rating }}/5)</span>
                </p>

                <p class="text-gray-700">{{ $review->comment }}</p>
            </div>
        @endforeach
    @else
        <p class="text-gray-600">No reviews yet. Be the first to leave a review!</p>
    @endif
</div>


<!-- Review Submission Form -->
<h3 class="text-lg font-semibold mt-6">Leave a Review</h3>
<form action="{{ route('reviews.store') }}" method="POST" class="mt-4">
    @csrf
    <div>
        <label class="block text-sm font-medium text-gray-600">Your Name</label>
        <input type="text" name="name" class="w-full p-2 border rounded-md" required>
    </div>

    <div class="mt-2">
        <label class="block text-sm font-medium text-gray-600">Your Rating</label>
        <select name="rating" class="w-full p-2 border rounded-md" required>
            <option value="5">⭐⭐⭐⭐⭐ - Excellent</option>
            <option value="4">⭐⭐⭐⭐ - Very Good</option>
            <option value="3">⭐⭐⭐ - Good</option>
            <option value="2">⭐⭐ - Fair</option>
            <option value="1">⭐ - Poor</option>
            <option value="0">No Rating</option>
        </select>
    </div>

    <div class="mt-2">
        <label class="block text-sm font-medium text-gray-600">Your Review</label>
        <textarea name="comment" class="w-full p-2 border rounded-md" required></textarea>
    </div>
    <input type="hidden" name="parent_id" value="">
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md mt-2">Submit Review</button>
</form>
<script>
    function toggleReplyForm(id) {
        let form = document.getElementById('reply-form-' + id);
        if (form) {
            form.classList.toggle('hidden');
        }
    }

    function updateTotalPrice() {
            let pricePerDay = 150;
            let quantity = document.getElementById("quantity").value;
            let days = document.getElementById("days").value;
            let totalPrice = pricePerDay * quantity * days;
            document.getElementById("total-price").innerText = + totalPrice.toFixed(2);
        }
</script>
</div>
</body>

@endsection
