@extends('layouts.app')

@section('title', 'Home - T Shop')

@section('content')


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>T Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
</head>

<!-- Hero Section -->
<div class="container text-center my-5">
    <h1><strong>Welcome</strong> to Suit Up</h1>
    <div class="highlight">Find Your Perfect Costume</div>
</div>

<!-- Navigation Links -->
<div class="container text-center my-4">
    <a href="{{ route('categoriespage') }}" class="btn btn-primary mx-2">View Categories</a>
    <a href="{{ route('cart.view') }}" class="btn btn-secondary mx-2">Go to Cart</a>
    <a href="{{ route('account.edit') }}" class="btn btn-success mx-2">My Account</a>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-warning mx-2">See orders</a>
</div>

<!-- Product Grid -->
<div class="container">
    <div class="product-grid">
        <img src="{{ asset('images/girl.svg') }}" alt="Product 1" class="img-fluid">
        <img src="{{ asset('images/clothes.svg') }}" alt="Product 2" class="img-fluid">
        <img src="{{ asset('images/girl.svg') }}" alt="Product 3" class="img-fluid">
    </div>
</div>

<!-- Latest Additions -->
<div class="container mt-5">
    <h2 class="text-center mb-4 fw-bold">Latest Additions</h2>
    <div class="row g-3">
        @foreach($costumes->take(4) as $costume)
            <div class="col-md-3">
                <div class="card h-100 d-flex flex-column border-0">
                    <a href="{{ route('product.show', ['id' => $costume->id]) }}">
                        <img src="{{ asset($costume->image) }}" class="card-img-top img-fluid" alt="{{ $costume->name }}" style="height: 350px; object-fit: cover;">
                    </a>
                    <div class="card-body text-center flex-grow-1">
                        <h6 class="card-title">{{ $costume->name }}</h6>
                        <p class="card-text">₱{{ number_format($costume->price, 2) }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@push('scripts')
<script>
    updateCartBadge();
    (function() {
    // Only reload once per navigation
    if (sessionStorage.getItem('didHardReload')) {
      sessionStorage.removeItem('didHardReload');
      return;
    }

    window.addEventListener('pageshow', function(event) {
      // event.persisted is true when coming back from bfcache
      // performance.navigation.type === 1 is a manual reload (we skip)
      const navEntries = performance.getEntriesByType('navigation');
      const navType = navEntries[0]?.type || '';
      
      if (event.persisted || navType === 'navigate') {
        // mark so we don't infinite‐reload
        sessionStorage.setItem('didHardReload', '1');
        window.location.reload(true);
      }
    });
  })();
// whenever some other page writes cartCount, update immediately:
window.addEventListener('storage', function(e) {
  if (e.key === 'cartCount') {
    document.getElementById('cart-count').textContent = e.newValue;
  }
});
function updateCartBadge() {
    fetch('{{ route("cart.count") }}', {
      headers: { 'X-Requested-With': 'XMLHttpRequest' },
      cache: 'no-store'
    })
    .then(res => res.json())
    .then(json => {
      const b = document.getElementById('cart-count');
      if (b && Number.isInteger(json.cart_count)) {
        b.textContent = json.cart_count;
      }
    })
    .catch(console.error);
  }

  // on initial load
  document.addEventListener('DOMContentLoaded', updateCartBadge);

  // catch back/forward navigations
  window.addEventListener('pageshow', updateCartBadge);

  // catch when returning from another page via a link or tab switch
  window.addEventListener('focus', updateCartBadge);

  // **NEW** when page becomes visible again
document.addEventListener('visibilitychange', () => {
  if (!document.hidden) updateCartBadge();
});
</script>
@endpush

@endsection
