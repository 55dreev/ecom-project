<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suit Up - Admin Dashboard</title>

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Bootstrap for optional components -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #E8E6F1;
            padding: 0;
            display: flex;
        }
        .sidebar {
            width: 250px;
            background: #fff;
            padding: 20px;
            height: 133vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }
        .sidebar a {
            display: block;
            padding: 12px;
            color: #333;
            text-decoration: none;
            margin: 10px 0;
            background: #f8f9fa;
            border-radius: 12px;
            text-align: center;
            transition: background 0.3s ease-in-out, transform 0.2s ease-in-out;
        }
        .sidebar a:hover {
            background: #10eb4b;
            color: white;
            transform: scale(1.05);
        }
        .main-content {
            flex: 1;
            padding: 20px;
        }
        .chat-container {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            height: 60vh;
            overflow-y: auto;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        .chat-box {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .message {
            padding: 10px;
            border-radius: 12px;
            max-width: 70%;
        }
        .admin-message {
            background: #10eb4b;
            color: white;
            align-self: flex-end;
        }
        .user-message {
            background: #f1f1f1;
            color: #333;
            align-self: flex-start;
        }
        .chat-input {
            margin-top: 10px;
            display: flex;
            gap: 10px;
        }
    </style>
</head>

<body class="flex">

<div class="sidebar">
    <h2>Admin Panel</h2>
    <a href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    <a href="{{ route('admin.products') }}"><i class="fas fa-shopping-cart"></i> Products</a>
    <a href="{{ route('admin.chat') }}"><i class="fas fa-comments"></i> Chat</a>
    <a href="{{ route('logout') }}" class="signout-btn mt-auto">Sign Out</a>
</div>

<!-- Main Content -->
<main class="flex-1 p-10">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-semibold text-green-400">Dashboard</h1>
            <p class="text-gray-500">Hi, Lorem Ipsum. Welcome back to Suit Up Admin!</p>
        </div>
        <div class="flex items-center">
            <input type="text" placeholder="Search here" class="border rounded px-4 py-2 mr-4">
            <button class="bg-red-500 hover:bg-red-600 p-2 rounded text-white">Settings</button>
        </div>
    </div>

    <!-- Top Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
        <div class="bg-white p-6 rounded shadow text-center">
            <div class="text-xl font-bold">{{ $totalOrders }}</div>
            <p class="text-gray-500">Total Orders</p>
        </div>
        <div class="bg-white p-6 rounded shadow text-center">
            <div class="text-xl font-bold">{{ $totalDelivered }}</div>
            <p class="text-gray-500">Total Delivered</p>
        </div>
        <div class="bg-white p-6 rounded shadow text-center">
            <div class="text-xl font-bold">{{ $totalCanceled }}</div>
            <p class="text-gray-500">Total Canceled</p>
        </div>
        <div class="bg-white p-6 rounded shadow text-center">
            <div class="text-xl font-bold">${{ $totalRevenue }}</div>
            <p class="text-gray-500">Total Revenue</p>
        </div>
    </div>

    <!-- Charts --> 
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
        <div class="bg-white p-6 rounded shadow">
            <canvas id="pieChart"></canvas>
        </div>
        <div class="bg-white p-6 rounded shadow">
            <canvas id="lineChart"></canvas>
        </div>
    </div>

    <!-- Customer Reviews -->
    <h2 class="text-2xl font-bold mb-4">Customer Reviews</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
  
            <div class="bg-white p-6 rounded shadow">
                <div class="font-bold"></div>
                <p class="text-gray-500 text-sm mt-2"></p>
                <div class="flex items-center mt-4">
                    <span class="text-yellow-400 mr-2"></span>
                    <span class="text-gray-500"></span>
                </div>
            </div>
      
    </div>
</main>

<!-- Scripts -->
<script>
    const pieCtx = document.getElementById('pieChart').getContext('2d');
    new Chart(pieCtx, {
        type: 'pie',
        data: {
            labels: ['Total Orders', 'Delivered', 'Canceled'],
            datasets: [{
                label: 'Orders Summary',
                data: [
                    {{ $totalOrders }},
                    {{ $totalDelivered }},
                    {{ $totalCanceled }}
                ],
                backgroundColor: ['#60A5FA', '#34D399', '#F87171'],
            }]
        },
    });

    const lineCtx = document.getElementById('lineChart').getContext('2d');
    new Chart(lineCtx, {
        type: 'line',
        data: {
            labels: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
            datasets: [{
                label: 'Orders Per Day',
                data: {!! json_encode($chartData) !!},
                fill: true,
                backgroundColor: 'rgba(96,165,250,0.2)',
                borderColor: '#60A5FA',
                tension: 0.4
            }]
        },
    });
</script>


</script>

</body>
</html>
