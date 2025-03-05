<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: black;
            padding: 10px;
            text-align: center;
        }

        header img {
            max-width: 100px;
        }

        h2, h3 {
            text-align: center;
            color: #333;
        }

        form {
            width: 50%;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }

        input, select, textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        textarea {
            height: 80px;
        }

        button {
            background-color: black;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            width: 48%;
            margin-top: 15px;
        }

        button:hover {
            background-color: #333;
        }

        footer {
            background-color: black;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 20px;
        }

        footer img {
            max-width: 80px;
            display: block;
            margin: 0 auto;
        }

        footer nav a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
        }

        footer nav {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <header>
        <img src="logo.png" alt="Logo">
    </header>
    
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
    
    <footer>
        <img src="logo.png" alt="Logo">
        <p>Tel: +63 945-298-5741</p>
        <nav>
            <a href="#">Shop</a>
            <a href="#">About Us</a>
            <a href="#">Subscribe</a>
            <a href="#">FAQ</a>
            <a href="#">Store Policy</a>
            <a href="#">Shipping & Returns</a>
            <a href="#">Payment Methods</a>
        </nav>
    </footer>
</body>
</html>
