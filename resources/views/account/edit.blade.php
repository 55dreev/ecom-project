@extends('layouts.headerfooter')

@section('title', 'Account Page')

@section('content')
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>T SHOP - Account</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="{{ asset('css/account.css') }}">
</head>

<div class="account-section container my-5">
  <div class="account-banner d-flex align-items-center mb-4">
    <img src="{{ asset('images/spider.png') }}" alt="Profile" class="rounded-circle me-3" width="80">
    <h3>{{ $user->name }} {{ $user->name }}</h3>
  </div>

  <nav class="nav mb-3">
    <a class="nav-link" href="#">My Addresses</a>
    <a class="nav-link" href="#">My Wallet</a>
    <a class="nav-link" href="{{ route('admin.orders.index') }}">My Bookings</a>
    <a class="nav-link active" href="#">My Account</a>
  </nav>
  <hr>

  <h2>Account</h2>
  <p>View and edit your personal info below.</p>

  <form action="{{ route('account.update') }}" method="POST">
    @csrf

    <h5 class="mt-4">Personal Info</h5>
    <div class="row mb-3">
      <div class="col">
        <label class="form-label">First name</label>
        <input 
          type="text" 
          name="first_name" 
          class="form-control" 
          value="{{ old('first_name', $user->name) }}">
        @error('first_name')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
      <div class="col">
        <label class="form-label">Last name</label>
        <input 
          type="text" 
          name="last_name" 
          class="form-control" 
          value="{{ old('last_name', $user->name) }}">
        @error('last_name')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label">Phone</label>
      <input 
        type="text" 
        name="phone" 
        class="form-control" 
        value="{{ old('phone', $user->phone) }}">
      @error('phone')
        <small class="text-danger">{{ $message }}</small>
      @enderror
    </div>

    <h5 class="mt-4">Login Info</h5>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p>
      <strong>Password:</strong> ••••••••
      <a href="#" class="ms-2">change</a>
    </p>

    <div class="mt-4">
      <button type="reset" class="btn btn-outline-dark">Discard</button>
      <button type="submit" class="btn btn-dark">Update Info</button>
    </div>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
