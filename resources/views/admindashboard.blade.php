<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff; /* White main background */
            display: flex;
        }
        .sidebar {
            width: 250px;
            background: #fff; /* White sidebar */
            padding: 20px;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }
        .sidebar h2 {
            text-align: center;
            color: #333;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .sidebar a {
            display: block;
            padding: 12px;
            color: #333;
            text-decoration: none;
            margin: 10px 0;
            background: #f8f9fa; /* Light gray for better contrast */
            border-radius: 12px; /* Smoother edges */
            text-align: center;
            transition: background 0.3s ease-in-out, transform 0.2s ease-in-out;
        }
        .sidebar a:hover {
            background: #10eb4b; /* Green on hover */
            color: white;
            transform: scale(1.05);
        }
        .signout {
            margin-top: auto;
            background: #bf1134 !important; /* Red sign-out button */
            color: white;
        }
        .signout:hover {
            background: #b71c1c !important;
        }
        .main-content {
            flex: 1;
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            background: #fff;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        .dashboard-stats {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }
        .stat-box {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            flex: 1;
            text-align: center;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }
        .stat-box:hover {
            transform: scale(1.05);
        }
        .placeholder-box {
            background: #fff;
            padding: 50px;
            text-align: center;
            border-radius: 12px;
            margin-top: 20px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
<div class="sidebar d-flex flex-column">
<img src="{{ asset('images/suitup.png') }}" alt="Suit Up Logo" class="img-fluid mb-3" style="max-width: 150px; margin-left: 35px;">

    
    <a href="#" class="sidebar-btn">Dashboard</a>
    <a href="#" class="sidebar-btn">Orders</a>
    <a href="#" class="sidebar-btn">Products</a>
    <a href="#" class="sidebar-btn">Chat</a>

    <!-- Sign Out button at the bottom -->
    <a href="{{ route('logout') }}" class="sidebar-btn mt-auto">Sign Out</a>
</div>



    <div class="main-content">
        <div class="header d-flex justify-content-between align-items-center">
            <input type="text" class="form-control w-50" placeholder="Search here">
            <span>Hello, Admin</span>
        </div>

        <div class="dashboard-stats row">
            <div class="col-md-3">
                <div class="stat-box">Total Orders</div>
            </div>
            <div class="col-md-3">
                <div class="stat-box">Total Delivered</div>
            </div>
            <div class="col-md-3">
                <div class="stat-box">Total Canceled</div>
            </div>
            <div class="col-md-3">
                <div class="stat-box">Total Revenue</div>
            </div>
        </div>

        <div class="placeholder-box">[Chart Placeholder]</div>
        <div class="placeholder-box">[Customer Reviews Placeholder]</div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
