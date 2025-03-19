@extends('layouts.headerfooter')

@section('title', 'Checkout - T Shop')

@section('content')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/booking.css') }}">
    <title>Checkout</title>
</head>

<body>
    <h2>My Cart</h2>
    <table>
        <thead>
            <tr>
                <th>Image</th>
                <th>Item</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Days</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php $grandTotal = 0; @endphp
            @foreach($cartItems as $item)
                @php 
                    $itemTotal = $item->price * $item->quantity * $item->days;
                    $grandTotal += $itemTotal;
                @endphp
                <tr>
                    <td><img src="{{ asset('images/'.$item->image) }}" width="60"></td>
                    <td>{{ $item->item_name }}</td>
                    <td>₱{{ number_format($item->price, 2) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->days }}</td>
                    <td>₱{{ number_format($itemTotal, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3 style="margin-top: 20px;">Total: ₱{{ number_format($grandTotal, 2) }}</h3>

    <hr style="margin: 30px 0;">

    <h2>Client Details</h2>
    <form action="/submit-checkout" method="POST">
        @csrf

        <label>First Name *</label>
        <input type="text" name="first_name" required>

        <label>Last Name *</label>
        <input type="text" name="last_name" required>

        <label>Email *</label>
        <input type="email" name="email" required>

        <label>Phone</label>
        <input type="text" name="phone">

        <label>Country/Region *</label>
        <select name="region" required>
            <option value="">Select</option>
            <option value="Region I">Ilocos Region</option>
            <option value="Region II">Cagayan Valley</option>
            <option value="Region III">Central Luzon</option>
            <option value="NCR">National Capital Region</option>
            <option value="Region IV-A">CALABARZON</option>
            <option value="Region IV-B">MIMAROPA</option>
            <option value="Region V">Bicol Region</option>
            <option value="Region VI">Western Visayas</option>
            <option value="Region VII">Central Visayas</option>
            <option value="Region VIII">Eastern Visayas</option>
            <option value="Region IX">Zamboanga Peninsula</option>
            <option value="Region X">Northern Mindanao</option>
            <option value="Region XI">Davao Region</option>
            <option value="Region XII">SOCCSKSARGEN</option>
            <option value="Region XIII">Caraga</option>
            <option value="BARMM">Bangsamoro Autonomous Region</option>
        </select>

        <label>Address *</label>
        <input type="text" name="address" required>

        <label>City *</label>
        <input type="text" name="city" required>

        <label>Zip / Postal Code *</label>
        <input type="text" name="zip_code" required>

        <label>Payment Method *</label>
        <select name="payment_method" required>
            <option value="">Select</option>
            <option value="pay_in_person">Pay in Person</option>
            <option value="credit_card">Credit Card</option>
            <option value="bank_transfer">Bank Transfer</option>
            <option value="gcash">GCash</option>
            <option value="paypal">PayPal</option>
        </select>

        <input type="hidden" name="total_amount" value="{{ $grandTotal }}">

        <button type="submit" style="margin-top: 20px;">Proceed to Payment</button>
    </form>
</body>

@endsection
