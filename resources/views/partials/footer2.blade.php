<footer>
    <div class="row align-items-center text-center py-4 border-bottom w-100"></div>
    <div class="row text-gray">
        <div class="col-md-3 p-4 text-white text-center" style="background-color: black;">
            <h5>T SHOP</h5>
            <p>info@mysite.com</p>
            <p>Tel: 123-456-7890</p>
            <div>
                <i class="bi bi-facebook mx-1"></i>
                <i class="bi bi-instagram mx-1"></i>
                <i class="bi bi-pinterest mx-1"></i>
                <i class="bi bi-tiktok mx-1"></i>
            </div>
        </div>
        <div class="col-md-3 p-4">
            <h6 class="fw-bold">Shop</h6>
            <p>New</p>
            <p>Women</p>
            <p>Men</p>
        </div>
        <div class="col-md-3 p-4">
            <h6 class="fw-bold">Our Store</h6>
            <a class="nav-link" href="{{ route('about') }}"><p>About Us</p></a>
            <p>Subscribe</p>
            <a class="nav-link" href="{{ route('info') }}#faq"><p>FAQ</p></a>
        </div>
        <div class="col-md-3 p-4">
            <h6 class="fw-bold">Terms & Conditions</h6>
            <a class="nav-link" href="{{ route('info') }}#store-policy"><p>Store Policy</p></a>
            <a class="nav-link" href="{{ route('info') }}#shipping-returns"><p>Shipping & Returns</p></a>
            <a class="nav-link" href="{{ route('info') }}#payment-methods"><p>Payment Methods</p></a>
        </div>
    </div>
</footer>
