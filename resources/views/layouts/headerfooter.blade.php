<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'T Shop')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<div class="promo-banner text-center p-2 bg-warning">
        Sale is on! 25% off sitewide using TEE25 at checkout
</div>

  <!-- Navbar -->
  @include('partials.navbar')

<div class="container mt-4">
    @yield('content')
</div>

<!-- Footer -->
@include('partials.footer2')