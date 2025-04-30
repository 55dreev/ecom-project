@extends('layouts.headerfooter')

@section('title', 'Orders - T Shop')

@section('content')
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>T SHOP - Orders</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css">
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
      <th>ID</th>
      <th colspan="4">Items</th>
      <th>Status</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach($orders as $order)
      {{-- order header row --}}
      <tr class="order-header">
        <td>{{ $order->id }}</td>
        <td colspan="4">
          {{-- you could also summarize, but we’ll just say “X items” --}}
          {{ count(json_decode($order->items)) }} item(s)
        </td>
        <td>
          <span class="status-badge">{{ ucfirst($order->status) }}</span>
        </td>
        <td>
          <a href="{{ route('orders.edit', $order) }}">Edit</a>
          <form action="{{ route('orders.destroy', $order) }}" method="POST" style="display:inline">
            @csrf @method('DELETE')
            <button>Delete</button>
          </form>
        </td>
      </tr>

      {{-- now each line item --}}
      @foreach(json_decode($order->items) as $item)
      <tr>
        <td></td> {{-- empty under the “ID” column --}}
        <td><img src="{{ asset($item->image) }}" width="60"></td>
        <td>{{ $item->name }}</td>
        <td>{{ $item->quantity }} × ₱{{ number_format($item->price,2) }}</td>
        <td>{{ $item->days }} day(s)</td>
        <td></td> {{-- empty under the “Status” column --}}
        <td></td> {{-- empty under “Actions” --}}
      </tr>
      @endforeach
    @endforeach
  </tbody>
</table>

    @endif
</div>
@endsection
