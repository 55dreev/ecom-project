@extends('layouts.headerfooter')

@section('title', 'Cart - T Shop')

@section('content')

<head>
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
    <style>
            .hidden {
        display: none !important;
        }

        .cart-section {
            max-width: 1100px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        h2 {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 15px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            color: #333;
        }

        td img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            transition: transform 0.3s;
        }

        td img:hover {
            transform: scale(1.1);
        }

        .remove-btn {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .remove-btn:hover {
            background-color: #c82333;
        }

        .checkout-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 30px;
            background-color: #ffc107;
            color: #333;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            transition: background 0.3s;
            cursor: pointer;
            border: none;
        }

        .checkout-btn:hover {
            background-color: #e0a800;
        }

        .cart-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 30px;
        }

        .total-price {
            font-size: 22px;
            font-weight: bold;
        }

        .cart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .cart-header h2 {
            margin: 0;
        }

        .cart-header a {
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s;
        }

        .cart-header a:hover {
            color: #0056b3;
        }
    </style>
</head>

<div class="cart-section">
<div id="cart-notification" class="alert alert-success fade" role="alert" style="display:none">
</div>


    <div class="cart-header">
        <h2>My Cart</h2>
        <a href="{{ route('categoriespage') }}">← Continue Browsing</a>
    </div>

    <hr>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @php
        $userCartItems = $cartItems;
        $grandTotal = $userCartItems->sum('total_price');
    @endphp

    <div id="empty-cart-block" style="{{ $userCartItems->isEmpty() ? '' : 'display:none' }}">
    <div class="cart-content">
        <p>Your cart is currently empty.</p>
        <a href="{{ route('categoriespage') }}" class="text-decoration-none">
        Continue Browsing
        </a>
    </div>
    <hr>
    </div>
    <div id="cart-container" style="{{ $userCartItems->isEmpty() ? 'display:none' : '' }}">
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Days</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($userCartItems as $item)
                    <tr id="cart-row-{{ $item->id }}">
                        <td><img src="{{ asset($item->image) }}" alt="{{ $item->name }}"></td>
                        <td>{{ $item->name }}</td>
                        <td>₱{{ number_format($item->price, 2) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->days }}</td>
                        <td>₱{{ number_format($item->total_price, 2) }}</td>
                        <td>
                        <form class="remove-from-cart-form inline" action="{{ route('cart.remove', ['id' => $item->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="remove-btn">Remove</button>
                        </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
           
            <div class="cart-footer">
                <div class="total-price">Total: ₱{{ number_format($grandTotal, 2) }}</div>
                
                <!-- AJAX Checkout -->
                <form id="checkout-form">
                    @csrf
                    <input type="hidden" name="grand_total" value="{{ $grandTotal }}">
                    <button type="submit" class="checkout-btn">Proceed to Checkout</button>
                </form>
            </div>
        </div>
    <hr>
</div>


<!-- ✅ Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@push('scripts')

<script>
    $(document).ready(function () {
        $('#checkout-form').on('submit', function (e) {
            e.preventDefault();

            let formData = $(this).serialize();

            $.ajax({
                url: '{{ route("checkout") }}',   // Ensure this matches your checkout route
                method: 'POST',
                data: formData,
                success: function (response) {
                    if (response.success) {
                        // ✅ Open PayMongo checkout page in a new tab
                        window.open(response.checkout_url, '_blank');

                        // ✅ Automatically refresh the page after 1 second
                        setTimeout(() => {
                            location.reload();
                        }, 300);
                    } else {
                        alert(response.message);
                    }
                },
                error: function () {
                    alert('Failed to process checkout.');
                }
            });
        });
    });
    document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.remove-from-cart-form').forEach(form => {
    form.addEventListener('submit', async e => {
      e.preventDefault();

      const note    = document.getElementById('cart-notification');
      const badge   = document.getElementById('cart-count');
      const formData= new FormData(form);

      try {
        const res  = await fetch(form.action, {
          method: 'POST',
          body: formData,
          headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
          }
        });
        const data = await res.json();

        // inject message & swap classes
        note.textContent = data.message;
        note.classList.remove('alert-success','alert-danger');
        note.classList.add(data.success ? 'alert-success' : 'alert-danger');
        note.style.display = 'block';

        // update badge
        if (badge && data.cart_count != null) {
          badge.textContent = data.cart_count;
          badge.classList.add('animate-pulse');
          setTimeout(()=> badge.classList.remove('animate-pulse'), 300);
        }

        // remove the row
        if (data.success) {
          form.closest('tr')?.remove();
          // swap to empty view if needed
          const tbody = document.querySelector('#cart-container tbody');
          if (!tbody || tbody.children.length===0) {
            document.getElementById('cart-container').style.display = 'none';
            document.getElementById('empty-cart-block').style.display = '';
          }
        }

        // auto-dismiss after 1s
        setTimeout(() => {
          // fade out
          note.classList.add('fade');
          note.classList.remove('show');
          // completely hide when done
          note.addEventListener('transitionend', () => note.style.display = 'none', { once: true });
        }, 1000);

      } catch (err) {
        console.error(err);
      }
    });
  });
});
</script>
@endpush



@endsection