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
                    <span id="min-price">₱15</span>
                    <input type="range" class="form-range" id="priceRange" min="15" max="100" step="1" value="50">
                    <span id="max-price">₱100</span>
                </div>
                <hr> <!-- Line below the price slider -->
        </div>

        <!-- Product Cards Section (Right) -->
        
        <div class="col-md-9">
    <div class="row" id="productContainer">
        <h1 class="text-start mb-4 fw-bold">Latest Additions</h1>
        
        <div class="col-md-3 col-sm-6 mb-4" data-price="75">
            <div class="card h-100 border-0">
                <img src="{{ asset('images/gown.svg') }}" class="card-img-top img-fluid" 
                     alt="Classic Witch Costume" 
                     style="max-height: 350px; object-fit: contain;">
                <div class="card-body text-center">
                    <h6 class="card-title">Classic Witch Costume</h6>
                    <p class="card-text">$75.00</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 mb-4" data-price="18">
            <div class="card h-100 border-0">
                <img src="{{ asset('images/glove.jpg') }}" class="card-img-top img-fluid" 
                     alt="Skeleton Gloves" 
                     style="max-height: 350px; object-fit: contain;">
                <div class="card-body text-center">
                    <h6 class="card-title">Skeleton Gloves</h6>
                    <p class="card-text">$18.00</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 mb-4" data-price="20">
            <div class="card h-100 border-0">
                <img src="{{ asset('images/glasses.png') }}" class="card-img-top img-fluid" 
                     alt="Retro Sunglasses" 
                     style="max-height: 350px; object-fit: contain;">
                <div class="card-body text-center">
                    <h6 class="card-title">Retro Sunglasses</h6>
                    <p class="card-text">$20.00</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 mb-4" data-price="40">
            <div class="card h-100 border-0">
                <img src="{{ asset('images/makeup.png') }}" class="card-img-top img-fluid" 
                     alt="Zombie Makeup Kit" 
                     style="max-height: 350px; object-fit: contain;">
                <div class="card-body text-center">
                    <h6 class="card-title">Zombie Makeup Kit</h6>
                    <p class="card-text">$40.00</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 mb-4" data-price="30">
            <div class="card h-100 border-0">
                <img src="{{ asset('images/spider.png') }}" class="card-img-top img-fluid" 
                     alt="Giant Spider Prop" 
                     style="max-height: 350px; object-fit: contain;">
                <div class="card-body text-center">
                    <h6 class="card-title">Giant Spider Prop</h6>
                    <p class="card-text">$30.00</p>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
<div class="row align-items-center text-center py-4 border-bottom"></div>

<script>
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
</script>
</body>
</head>

@endsection