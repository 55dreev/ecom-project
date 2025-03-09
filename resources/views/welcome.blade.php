<!DOCTYPE html>
<html lang="en">
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
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <script>
        function updateTotalPrice() {
            let pricePerDay = 150;
            let quantity = document.getElementById("quantity").value;
            let days = document.getElementById("days").value;
            let totalPrice = pricePerDay * quantity * days;
            document.getElementById("total-price").innerText = + totalPrice.toFixed(2);
        }
    </script>
</head>
<body class="bg-gray-100">
   <!-- Promo Banner -->
<div class="promo-banner text-center p-2 bg-success text-white">
    Dress to impress! Get 25% off all costume rentals—Use code TEE25 at checkout!
</div>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
    <div class="text-green-500 font-bold text-lg px-2 max-h-10 h-10 w-auto !max-h-10 m-0 drop-shadow-[0_0_2px_black]">
    SUIT UP
</div>

<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="#">New</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Women</a></li>
                <li class="nav-item"><a class="nav-link" href="#">More</a></li>
            </ul>
        </div>
        <div class="nav-icons">
            <a href="#"><i class="bi bi-person"></i></a>
            <a href="#"><i class="bi bi-bag"></i></a>
        </div>
    </div>
</nav>

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
                <button class="bg-black text-white px-4 py-2 rounded-md mt-2">Buy Now</button>
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

<!-- Display Existing Reviews -->
<div class="bg-white p-4 rounded-lg shadow-md mt-4">
    @if(isset($reviews) && $reviews->count())
        @foreach ($reviews as $review)
            <div class="border-b pb-2 mb-2">
                <p><strong>{{ $review->name }}</strong></p>
                <p>{{ $review->comment }}</p>

                <!-- Reply Form -->
                <button onclick="toggleReplyForm(@json($review->id))" class="text-blue-500 text-sm">Reply</button>  
                <form action="{{ route('reviews.store') }}" method="POST" class="mt-2 hidden" id="reply-form-{{ $review->id }}">
                    @csrf
                    <input type="hidden" name="parent_id" value="{{ $review->id }}">
                    <input type="text" name="name" placeholder="Your Name" class="w-full p-2 border rounded-md mb-2" required>
                    <textarea name="comment" placeholder="Your Reply" class="w-full p-2 border rounded-md mb-2" required></textarea>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Submit Reply</button>
                </form>

                <!-- Replies -->
                @if($review->replies->count())
                    <div class="ml-4 border-l pl-2 mt-2">
                        @foreach ($review->replies as $reply)
                            <p><strong>{{ $reply->name }}</strong>: {{ $reply->comment }}</p>
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
    @else
        <p>No reviews yet. Be the first to leave a review!</p>
    @endif
</div>

<!-- Review Form -->
<h3 class="text-lg font-semibold mt-6">Leave a Review</h3>
<form action="{{ route('reviews.store') }}" method="POST" class="mt-4">
    @csrf
    <div>
        <label class="block text-sm font-medium text-gray-600">Your Name</label>
        <input type="text" name="name" class="w-full p-2 border rounded-md" required>
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
</script>


</div>
</body>
</html>
