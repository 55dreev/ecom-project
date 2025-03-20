<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('homepage') }}">T SHOP</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="{{ route('categoriespage') }}">Costumes</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About Us</a></li>
                <li class="nav-item"><a class="nav-link" href="#">More</a></li>
            </ul>
        </div>

        <div class="nav-icons d-flex align-items-center">
            <!-- Account Icon -->
            <a href="{{ route('account') }}" class="me-3"><i class="bi bi-person"></i></a>

            <!-- Cart Icon with Counter -->
            <a href="{{ route('cart.view') }}" class="position-relative">
                <i class="bi bi-bag"></i>
                <span id="cart-count" 
                      class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                      style="font-size: 12px; min-width: 20px;">
                    {{ session('cart_count', 0) }}
                </span>
            </a>
        </div>
    </div>
</nav>
