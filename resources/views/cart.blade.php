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
    .promo-banner {
        background: black;
        color: white;
        text-align: center;
        padding: 5px;
        font-size: 14px;
    }
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
    .cart-section {
        text-align: left;
        padding: 50px 20px;
        max-width: 800px;
        margin: auto;
    }
    .cart-section h2 {
        font-weight: bold;
        margin-bottom: 30px;
    }
    .cart-content {
        min-height: 400px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;
    }
    .cart-section hr {
        width: 100%;
        border: 1px solid black;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    th, td {
        border-bottom: 1px solid #ddd;
        padding: 10px;
        text-align: center;
    }
    th {
        background: #f4f4f4;
    }
    img {
        width: 50px;
        height: 50px;
        object-fit: cover;
    }
    .remove-btn {
        color: red;
        text-decoration: none;
    }
    .checkout-btn {
        display: block;
        width: 100%;
        text-align: center;
        background: #ffcc00;
        color: black;
        padding: 10px;
        margin-top: 20px;
        font-weight: bold;
        text-decoration: none;
        border-radius: 5px;
    }
</style>

<div class="cart-section">
    <h2>My Cart</h2>
    <hr>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(empty($cart) || count($cart) === 0)
        <div class="cart-content">
            <p>Cart is empty</p>
            <a href="{{ route('categoriespage') }}" class="text-decoration-none">Continue Browsing</a>
        </div>
    @else
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Days</th>
                    <th>Total</th>
                    <th>Remove</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $id => $item)
                <tr>
                    <td><img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}"></td>
                    <td>{{ $item['name'] }}</td>
                    <td>₱{{ number_format($item['price'], 2) }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>{{ $item['days'] }}</td>
                    <td>₱{{ number_format($item['total_price'], 2) }}</td>
                    <td>
                        <form action="{{ route('cart.remove', ['id' => $id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="remove-btn">Remove</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('bookingform') }}" class="checkout-btn">Proceed to Checkout</a>
    @endif

    <hr>
</div>

@endsection
