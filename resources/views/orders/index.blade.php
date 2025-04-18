@extends('layouts.headerfooter')

@section('title', 'Orders - T Shop')

@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
</head>
<style>
    .cart-section {
        max-width: 1000px;
        margin: 20px auto;
        background: #fff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .cart-section h2 {
        font-size: 24px;
        margin-bottom: 15px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead {
        background-color: #f4f4f4;
    }

    th, td {
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid #ddd;
        vertical-align: middle;
    }

    img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 6px;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        background-color: #f0ad4e;
        color: white;
        border-radius: 20px;
        font-size: 14px;
    }
</style>

<div class="cart-section">
    <h2>My Orders</h2>
    <hr>

    @if($orders->isEmpty())
        <p>No orders yet.</p>
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
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    @php
                        $items = json_decode($order->items);
                    @endphp
                    @foreach($items as $item)
                        <tr>
                            <td><img src="{{ asset($item->image) }}" alt="{{ $item->name }}" width="80"></td>
                            <td>{{ $item->name }}</td>
                            <td>₱{{ number_format($item->price, 2) }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->days }}</td>
                            <td>₱{{ number_format($item->total_price, 2) }}</td>
                            <td>{{ ucfirst($order->status) }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
