<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        .wrapper {
            display: flex;
            min-height: 100vh; /* Full height */
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
        body {
            font-family: Arial, sans-serif;

            background-color: #E8E6F1;
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
    </style>
    </style>
</head>
<body>

<div class="wrapper">
<div class="sidebar">
    <h2>Admin Panel</h2>
    <a href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    <a href="{{ route('admin.products') }}"><i class="fas fa-shopping-cart"></i> Products</a>
    <a href="{{ route('admin.chat') }}"><i class="fas fa-comments"></i> Chat</a>
    <a href="{{ route('logout') }}" class="signout-btn mt-auto">Sign Out</a>
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
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#orders">Orders</a>
            </li>

        </ul>
        <!-- <div class="row">
        <div class="col-md-6">
            <label class="form-label fw-bold">Categories *</label>
            <select name="category" class="form-control" required>
                <option selected disabled>Select an option</option>
                <option value="suits">Suits</option>
                <option value="shirts">Shirts</option>
                <option value="shoes">Shoes</option>
            </select>
            <small class="text-muted">Select the category</small>
        </div>

        <div class="col-md-6">
            <label class="form-label fw-bold">Size *</label>
            <select name="size" class="form-control" required>
                <option selected disabled>Select the size</option>
                <option value="S">Small</option>
                <option value="M">Medium</option>
                <option value="L">Large</option>
                <option value="XL">Extra Large</option>
            </select>
            <small class="text-muted">Select the size</small>
        </div>
    </div> -->
        <div class="tab-content p-4 card mt-3">
            <div class="tab-pane fade show active" id="general">
            <form id="product-form" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label class="form-label fw-bold">Costume Name *</label>
        <input type="text" name="name" class="form-control" placeholder="Costume Name" required>
    </div>

    <div class="mb-3">
        <label class="form-label fw-bold">Price *</label>
        <input type="number" name="price" class="form-control" placeholder="Price" required>
    </div>

    <div class="mb-3">
        <label class="form-label fw-bold">Description *</label>
        <textarea name="description" class="form-control" rows="4" required></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label fw-bold">Upload Image *</label>
        <input type="file" name="image" class="form-control" accept="image/*" required>
    </div>

    <button type="submit" class="btn btn-primary">Save Costume</button>

    <!-- Notification area -->
    <div id="notification" class="alert alert-success mt-3 d-none" role="alert">
        Costume saved successfully!
    </div>
</form>
</div>
<!-- Orders Tab -->
<div class="tab-pane fade" id="orders">
    <h4 class="fw-bold mb-3">Manage Orders</h4>
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Image</th>
                <th>Item</th>
                <th>Price</th>
                <th>Status</th>
                <th>Modify Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                @php
                    $items = json_decode($order->items);
                @endphp
                @foreach($items as $item)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>
                            <img src="{{ asset($item->image) }}" alt="{{ $item->name }}" width="80" height="80">
                        </td>
                        <td>{{ $item->name }}</td>
                        <td>₱{{ number_format($item->price, 2) }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                        <td>
                            <form method="POST" action="{{ route('orders.update', $order->id) }}" class="d-inline">
                                @csrf
                                @method('PUT')
                                <select name="status" onchange="this.form.submit()">
                                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="approved" {{ $order->status === 'approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                                    <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                                    <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </form>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('orders.destroy', $order->id) }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm delete-order" type="submit" onclick="return confirm('Are you sure you want to delete this order?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</div>



<div class="tab-pane fade" id="advanced">
    <h4 class="fw-bold mb-3">Manage Costumes</h4>

    <!-- Table for displaying products -->
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Image</th>
                <th>Item</th>
                <th>Price</th>
                <th>Remove</th>
            </tr>
        </thead>
        <tbody id="costume-table-body">
            @foreach($costumes as $costume)
                <tr id="costume-{{ $costume->id }}">
                    <td>
                        <img src="{{ asset($costume->image) }}" alt="{{ $costume->name }}" width="80" height="80">
                    </td>
                    <td>{{ $costume->name }}</td>
                    <td>₱{{ number_format($costume->price, 2) }}</td>
                    <td>
                        <button 
                            class="btn btn-danger btn-sm delete-costume" 
                            data-id="{{ $costume->id }}">
                            Remove
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Notification -->
    <div id="notification" class="alert d-none mt-3"></div>
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
    document.getElementById('product-form').addEventListener('submit', async function(event) {
        event.preventDefault();

        const formData = new FormData(this);

        try {
            const response = await fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            if (response.ok) {
                const result = await response.json();
                console.log(result);

                // Show notification
                const notification = document.getElementById('notification');
                notification.classList.remove('d-none');
                notification.textContent = result.message;
                setTimeout(() => {
    notification.classList.add('hidden');
}, 3000);  // Hide after 3 seconds

                // Clear form fields
                this.reset();
            } else {
                console.error('Failed to save costume.');
                alert('Failed to save costume.');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('An error occurred.');
        }
    });
    document.addEventListener('DOMContentLoaded', () => {
        const deleteForm = document.getElementById('delete-form');
        
        deleteForm.addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            let formData = new FormData(this);

            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success notification
                    const notification = document.getElementById('notification');
                    notification.textContent = data.message;
                    notification.classList.remove('d-none');
                    notification.classList.add('alert-success');
                    setTimeout(() => {
    notification.classList.add('hidden');
}, 3000);
                    // Remove the deleted item from the page
                    const imageName = formData.get('image').name;
                    const itemRow = document.querySelector(`[data-image="${imageName}"]`);
                    if (itemRow) {
                        itemRow.remove();
                    }
                } else {
                    alert(data.message);  // Show error message
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
    document.addEventListener('DOMContentLoaded', () => {
        const deleteButtons = document.querySelectorAll('.delete-costume');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const costumeId = this.getAttribute('data-id');

                if (!confirm('Are you sure you want to delete this costume?')) return;

                fetch(`/admin/products/delete/${costumeId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.querySelector(`#costume-${costumeId}`).remove();
                        showNotification('Costume deleted successfully!', 'success');
                    } else {
                        showNotification('Failed to delete costume.', 'danger');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('An error occurred.', 'danger');
                });
            });
        });

        function showNotification(message, type) {
            const notification = document.getElementById('notification');
            notification.classList.remove('d-none', 'alert-success', 'alert-danger');
            notification.classList.add(`alert-${type}`);
            notification.textContent = message;

            setTimeout(() => {
                notification.classList.add('d-none');
            }, 3000);
        }
    });
</script>
</body>
</html>
