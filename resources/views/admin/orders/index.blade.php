@extends('layouts.headerfooter')

@section('title', 'Orders - T Shop')

@section('content')

  <meta charset="UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>T SHOP - Orders</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<div class="container my-5">
  <div class="bg-white rounded-3 shadow-sm p-4">  {{-- ← Panel wrapper --}}
    <h2 class="fw-bold mb-4">My Orders</h2>

    @if($orders->isEmpty())
      <div class="alert alert-info">You have no orders yet.</div>
    @else
    <table class="table align-middle mb-0">
  <thead class="table-light">
    <tr>
      <th>Order ID</th>
      <th>Customer</th>
      <th>Image</th>
      <th>Item</th>
      <th>Price</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($orders as $order)
      @php $items = json_decode($order->items, true); @endphp
      @foreach($items as $item)
        <tr data-order-id="{{ $order->id }}">
          <td>{{ $order->id }}</td>
          <td>{{ $order->user->name }}</td>
          <td>
            <img src="{{ asset($item['image']) }}"
                 class="rounded"
                 style="width:60px;height:60px;object-fit:cover"
                 alt="">
          </td>
          <td>{{ $item['name'] }}</td>
          <td>₱{{ number_format($item['price'],2) }}</td>
          <td>
  <span class="badge status-badge bg-warning text-dark">
    {{ ucfirst($order->status) }}
  </span>
</td>
          <td>
            <button 
              class="btn btn-sm btn-danger js-delete-order"
              data-order-id="{{ $order->id }}"
              data-delete-url="{{ route('orders.destroy', $order) }}"
            >
              Delete
            </button>
          </td>
        </tr>
      @endforeach
    @endforeach
  </tbody>
</table>

    @endif
  </div>
</div>



<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.11.3/echo.iife.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // 1️⃣ Initialize Echo right away, immediately.
  window.Echo = new Echo({
      broadcaster: 'pusher',
      key: '{{ config('broadcasting.connections.pusher.key') }}',
      cluster: '{{ config('broadcasting.connections.pusher.options.cluster') }}',
      forceTLS: true,
      encrypted: true,
      namespace: '',
      enabledTransports: ['ws', 'wss'],
      authEndpoint: '/broadcasting/auth',
      auth: {
          headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
          }
      }
  });

  document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('tr[data-order-id]').forEach(tr => {
    const id = tr.dataset.orderId;

    console.log(`Subscribing to private-orders.${id}`);
    Pusher.logToConsole = true;
    window.Echo.connector.pusher.connection.bind('connected', () =>
  console.log('✅ Pusher connected')
);
Echo.private(`orders.${id}`)
  .subscribed(() => console.log(`✅ Subscribed to orders.${id}`))
  .error(err => console.error('❌ Echo subscription error', err))
  .listen('OrderUpdated', payload => {
    console.log('📦 OrderUpdated payload', payload);

    if (parseInt(payload.order_id) !== parseInt(id)) {
      console.log(`Ignoring event for order ${payload.order_id}, because this row is for ${id}`);
      return;
    }

    const badge = tr.querySelector('.status-badge');
    if (!badge) {
      console.log('🚨 No badge found inside this row.');
      return;
    }

    const newStatus = payload.status.toLowerCase();

    const map = {
      pending:   ['bg-warning', 'text-dark'],
      approved:  ['bg-primary', 'text-white'],
      shipped:   ['bg-info', 'text-white'],
      delivered: ['bg-success', 'text-white'],
      cancelled: ['bg-danger', 'text-white']
    };

    // 🔁 Remove all possible status classes before applying the new ones
    badge.classList.remove('bg-warning', 'bg-primary', 'bg-info', 'bg-success', 'bg-danger', 'text-white', 'text-dark');

    // ✅ Add the correct class for the new status
    const classes = map[newStatus] || ['bg-secondary', 'text-white'];
    badge.classList.add(...classes);

    // ✏️ Update badge text
    badge.textContent = newStatus.charAt(0).toUpperCase() + newStatus.slice(1);
  });
  });
});
document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.js-delete-order').forEach(btn => {
    btn.addEventListener('click', async (e) => {
      e.preventDefault();

      const orderId = btn.dataset.orderId;
      const url     = btn.dataset.deleteUrl;

      if (!confirm("Are you sure you want to delete this order?")) return;

      try {
        const res = await fetch(url, {
          method: 'DELETE',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
          }
        });

        const data = await res.json();

        if (res.ok && data.success) {
          // Remove all rows matching this order ID
          document.querySelectorAll(`tr[data-order-id="${orderId}"]`)
                  .forEach(row => row.remove());

          // Optionally show a toast / alert
          const alert = document.createElement('div');
          alert.className = 'alert alert-success position-fixed top-0 end-0 m-3';
          alert.innerText = data.message || 'Order deleted';
          document.body.append(alert);
          setTimeout(() => alert.remove(), 2000);

        } else {
          throw new Error(data.message || 'Failed to delete');
        }

      } catch (err) {
        console.error(err);
        alert(err.message || 'An error occurred');
      }
    });
  });
});
</script>

@endsection
