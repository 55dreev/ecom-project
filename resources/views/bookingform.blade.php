@extends('layouts.headerfooter')

@section('title', 'Home - T Shop')

@section('content')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/bookingform.css') }}">
    <title>Booking Form</title>
</head>
<body>
    <h2>Client Details</h2>
    <form action="/submit-booking" method="POST">
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
        
        <label>Add your message</label>
        <textarea name="message"></textarea>
        
        <label>Payment for Service Name</label>
        <select name="payment_method">
            <option value="pay_in_person">Pay in person</option>
            <option value="credit_card">Credit Card</option>
            <option value="bank_transfer">Bank Transfer</option>
        </select>
        
        <h3>Booking Details</h3>
        <p>Service Name</p>
        <p>Date and Time</p>
        <p>Available Online</p>
        <p>Location</p>
        <p>Staff: 1 hr</p>
        
        <h3>Payment Details</h3>
        <p>Total:</p>
        
        <button type="submit">Add to Cart</button>
        <button type="submit">Book Now</button>
    </form>
    
</body>
@endsection
