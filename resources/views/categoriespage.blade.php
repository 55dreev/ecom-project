@extends('layouts.headerfooter')

@section('title', 'Categories Page')

@section('content')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>T Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/categoriespage.css') }}">
</head>

<body>  
    <div class="container mt-4">
        <div class="row">
            <!-- Filter Section (Left) -->
            <div class="col-md-3">
                <!-- Filter Sidebar (Left) -->
                <h5>Browse by</h5>
                <ul class="list-unstyled">
                    <li><a href="#">New Arrivals</a></li>
                    <li><a href="#">Best Sellers</a></li>
                    <li><a href="#">On Sale</a></li>
                </ul>

               <!-- Filter by Price -->
               <h3>Filter by</h3>
               <hr> 
                <h6>Price</h6>
                <!-- Line above the price slider -->
                <div class="price-slider">
                    <span id="min-price">₱100</span>
                    <input type="range" class="form-range" id="priceRange" min="100" max="6000" step="1" value="100">
                    <span id="max-price">₱6000</span>
                </div>
                <hr> <!-- Line below the price slider -->
        </div>

        <!-- Product Cards Section (Right) -->
        
        <div class="col-md-9">
    <div class="row" id="productContainer">
        <h1 class="text-start mb-4 fw-bold">Latest Additions</h1>
        @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

        @foreach($costumes as $costume)
    <div class="col-md-3 col-sm-6 mb-4" data-price="{{ $costume->price }}">
        <div class="card h-100 border-0">
            <a href="{{ route('costume.show', $costume->id) }}">
                <img src="{{ asset($costume->image) }}" alt="{{ $costume->name }}" class="card-img-top img-fluid" 
                     style="max-height: 350px; object-fit: contain;">
            </a>
            <div class="card-body text-center">
                <h6 class="card-title">
                    <a href="{{ route('costume.show', $costume->id) }}" class="text-dark text-decoration-none">
                        {{ $costume->name }}
                    </a>
                </h6>
                <p class="card-text">₱ {{ number_format($costume->price, 2) }}</p>
            </div>
        </div>
    </div>
@endforeach



    </div>
</div>


</div>




<script>
   updateCartBadge();

// whenever some other page writes cartCount, update immediately:
window.addEventListener('storage', function(e) {
  if (e.key === 'cartCount') {
    document.getElementById('cart-count').textContent = e.newValue;
  }
});

    const priceRange = document.getElementById("priceRange");
    const maxPrice = document.getElementById("max-price");
    const productContainer = document.getElementById("productContainer");
    const products = productContainer.getElementsByClassName("col-md-3");


    priceRange.addEventListener("input", function() {
        maxPrice.textContent = "₱" + priceRange.value;
        filterProducts();
    });

    function filterProducts() {
        const selectedPrice = parseInt(priceRange.value);
        for (let product of products) {
            const productPrice = parseInt(product.getAttribute("data-price"));
            product.style.display = productPrice <= selectedPrice ? "block" : "none";
        }
    }
    function updateCartBadge() {
    fetch('{{ route("cart.count") }}', {
      headers: { 'X-Requested-With': 'XMLHttpRequest' },
      cache: 'no-store'      // force fresh data
    })
    .then(res => res.json())
    .then(json => {
      const b = document.getElementById('cart-count');
      if (b && Number.isInteger(json.cart_count)) {
        b.textContent = json.cart_count;
      }
    })
    .catch(console.error);
  }

  // Always fetch on first load
  document.addEventListener('DOMContentLoaded', updateCartBadge);

  // Catch full reloads (pageshow will also fire here)
  window.addEventListener('pageshow', function(event) {
    updateCartBadge();
  });
</script>
</body>
</head>

@endsection