@extends('layouts.headerfooter')

@section('title', 'Cart - T Shop')

@section('content')

<style>
        html, body {
            overflow-x: hidden;
        }
        .container-fluid, .cart-section {
            flex: 1; /* Pushes the footer down */
        }

        /* Promo Banner */
        .promo-banner {
            background: black;
            color: white;
            text-align: center;
            padding: 5px;
            font-size: 14px;
        }
        /* Navbar */
        .navbar {
            background: white;
            border-bottom: 2px solid #ddd;
            padding: 0;
        }
        .container-fluid {
            padding-left: 0;
        }
        .navbar-brand {
            background: #F4FF5F;
            font-weight: bold;
            padding: 15px 20px;
            margin: 0;
            display: block;
        }
        .navbar-nav {
            margin: 0 auto;
        }
        .nav-item {
            margin: 0 10px;
        }
        .nav-icons {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .nav-icons a {
            font-size: 20px;
            color: black;
        }
        .navbar-nav .nav-item {
            position: relative;
            padding: 0 15px;
        }
        .navbar-nav .nav-item:not(:last-child)::after {
            content: "|";
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            color: black;
        }
        /* Align My Cart to the left */
        .cart-section {
            text-align: left;
            padding: 50px 20px;
            max-width: 800px; /* Adjust width to prevent overflow */
            margin: auto;
        }

        /* Increase space below My Cart */
        .cart-section h2 {
            font-weight: bold;
            margin-bottom: 30px; /* Adds more space below */
        }

        /* Make the empty cart space larger */
        .cart-content {
            min-height: 400px; /* Adjust to your preference */
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
        }
        /* Make hr lines longer */
        .cart-section hr {
            width: 100%;  /* Extend the line */
            border: 1px solid black; /* Adjust thickness and color */
        }

    </style>
    
<div class="cart-section">
    <h2>My Cart</h2>
    <hr>
    <div class="cart-content">
        <p>Cart is empty</p>
        <a href="#" class="text-decoration-none">Continue Browsing</a>
    </div>
    <hr>
</div>

@endsection
