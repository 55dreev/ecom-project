@extends('layouts.headerfooter')

@section('title', 'Orders - T Shop')

@section('content')
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
