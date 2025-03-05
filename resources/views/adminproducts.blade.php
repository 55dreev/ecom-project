<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            background-color: #E8E6F1;
            font-family: Arial, sans-serif;
        }
        .wrapper {
            display: flex;
            min-height: 100vh; /* Full height */
        }
        .sidebar {
            width: 250px;
            background: #fff; /* White sidebar */
            padding: 20px;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: start;
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
            background: #f8f9fa; !important; /* Red sign-out button */
            color: white;
        }
        .signout:hover {
            background: #b71c1c !important;
        }
        .main-content {
            flex: 1;
            padding: 30px;
        }
        .card {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        .form-control {
            border-radius: 8px;
        }
        .nav-tabs .nav-link.active {
            background: #C0E4D4;
            border-radius: 8px;
        }
        .btn-primary {
            background: #10eb4b;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
        }
        .btn-primary:hover {
            background: #0db33a;
        }

        .sidebar-btn i {
            margin-right: 10px; 
        }
    </style>
    </style>
</head>
<body>

<div class="wrapper">
    <div class="sidebar">
        <img src="{{ asset('images/suitup.png') }}" alt="Suit Up Logo" class="img-fluid mb-3" style="max-width: 150px; margin-left: 35px;">
        <a href="#" class="sidebar-btn"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="#" class="sidebar-btn"><i class="fas fa-box"></i> Orders</a>
        <a href="#" class="sidebar-btn"><i class="fas fa-shopping-cart"></i> Products</a>
        <a href="#" class="sidebar-btn"><i class="fas fa-comments"></i> Chat</a>

        <a href="{{ route('logout') }}" class="sidebar-btn mt-auto signout">Sign Out</a>
    </div>

    <div class="main-content">
        <h2 class="fw-bold">Add Product</h2>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#general">General</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#advanced">Advanced</a>
            </li>
        </ul>
        <div class="tab-content p-4 card mt-3">
            <div class="tab-pane fade show active" id="general">
            <form enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-6">
            <label class="form-label fw-bold">Categories *</label>
            <select class="form-control">
                <option selected disabled>Select an option</option>
                <option value="suits">Suits</option>
                <option value="shirts">Shirts</option>
                <option value="shoes">Shoes</option>
            </select>
            <small class="text-muted">Select the category</small>
        </div>

        <div class="col-md-6">
            <label class="form-label fw-bold">Size *</label>
            <select class="form-control">
                <option selected disabled>Select the size</option>
                <option value="S">Small</option>
                <option value="M">Medium</option>
                <option value="L">Large</option>
                <option value="XL">Extra Large</option>
            </select>
            <small class="text-muted">Select the size</small>
        </div>
    </div>

    <div class="mb-3 mt-3">
        <label class="form-label fw-bold">Product Name *</label>
        <input type="text" class="form-control" placeholder="Product Name">
    </div>

    <div class="mb-3">
        <label class="form-label fw-bold">Daily Rental Rate *</label>
        <input type="text" class="form-control" placeholder="Renting Value">
    </div>

    <div class="mb-3">
        <label class="form-label fw-bold">Description *</label>
        <textarea class="form-control" rows="4"></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label fw-bold">Upload Product Image *</label>
        <input type="file" class="form-control" id="productImage" accept="image/*" onchange="previewImage(event)">
        <small class="text-muted">Choose an image file (JPG, PNG, GIF).</small>
        <div class="mt-3">
            <img id="imagePreview" src="#" alt="Preview" class="img-fluid d-none" style="max-height: 200px; border-radius: 8px;">
        </div>
    </div>

    <button class="btn btn-primary">Save Product</button>
</form>

            </div>
            <div class="tab-pane fade" id="advanced">
                <p>Advanced settings will go here...</p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('imagePreview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('d-none'); // Show preview
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
</body>
</html>
