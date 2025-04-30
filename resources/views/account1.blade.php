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
<body>

    <!-- Account Section -->
    <div class="account-section">
        <div class="account-banner">
            <img src="/SuitUp/images/spider.png" alt="Profile">
            <h3>Karl Arman De Vera</h3>
        </div>
        <nav class="nav">
            <a class="nav-link active" href="#">My Addresses</a>
            <a class="nav-link" href="#">My Wallet</a>
            <a class="nav-link" href="#">My Bookings</a>
            <a class="nav-link" href="#">My Account</a>
        </nav>
        <hr>

        <h2>Account</h2>
        <p>View and edit your personal info below.</p>

        <form>
            <h5>Personal Info</h5>
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">First name</label>
                    <input type="text" class="form-control" value="Karl Arman">
                </div>
                <div class="col">
                    <label class="form-label">Last name</label>
                    <input type="text" class="form-control" value="De Vera">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text" class="form-control">
            </div>

            <h5>Login Info</h5>
            <p><strong>Login email:</strong> ksat2022-891-72421@bicol-u.edu.ph</p>
            <p><strong>Password:</strong> ••••••••</p>
            <button type="button" class="btn btn-outline-dark">Discard</button>
            <button type="submit" class="btn btn-dark">Update Info</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

@endsection
