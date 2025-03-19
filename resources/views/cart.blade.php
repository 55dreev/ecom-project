@extends('layouts.headerfooter')

@section('title', 'Cart - T Shop')

@section('content')

<head>
<link rel="stylesheet" href="{{ asset('css/cart.css') }}">
</head>

<div class="cart-section">
    <h2>My Cart</h2>
    <hr>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @php
    $userCartItems = $cartItems;
    @endphp

    @if($userCartItems->isEmpty())
        <div class="cart-content">
            <p>Your cart is currently empty.</p>
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
                @foreach($userCartItems as $item)
                <tr>
                    <td><img src="{{ asset($item->image) }}" alt="{{ $item->name }}"></td>
                    <td>{{ $item->name }}</td>
                    <td>₱{{ number_format($item->price, 2) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->days }}</td>
                    <td>₱{{ number_format($item->total_price, 2) }}</td>
                    <td>
                        <form action="{{ route('cart.remove', ['id' => $item->id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="remove-btn" aria-label="Remove item">Remove</button>
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