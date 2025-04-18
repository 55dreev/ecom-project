@extends('layouts.headerfooter')

@section('title', 'Orders - T Shop')

@section('content')
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
            <th>ID</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->status }}</td>
            <td>
                <a href="{{ route('orders.edit', $order->id) }}">Edit</a>
                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

    @endif
</div>
@endsection
