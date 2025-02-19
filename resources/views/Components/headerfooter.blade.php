
<head>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    
    <header>
        <div class="logo">SUIT UP!</div>
        <div class="cart-login">
            <i class="fas fa-shopping-cart"></i>
            @if(session('username'))
                <p>Welcome, {{ session('username') }}!</p>
                <a href="{{ route('logout') }}">
                    <button>Logout</button>
                </a>
            @else
                <a href="{{ route('signup') }}">
                    <button>Sign up</button>
                </a>
                <a href="{{ route('login') }}">
                    <button>Login</button>
                </a>
            @endif
        </div>
    </header>
    
    <main>
        @yield('content')
    </main>
    
    <footer>
    <div class="footer-container">
        <div class="footer-section">
            <h4>INFO</h4>
            <ul>
                <li><a href="#">Location</a></li>
                <li><a href="#">Costumes</a></li>
                <li><a href="#">Fees</a></li>
                <li><a href="#">Pricing</a></li>
                <li><a href="#">Payment Methods</a></li>
                <li><a href="#">Delivery</a></li>
                <li><a href="#">FAQs</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h4>ABOUT</h4>
            <ul>
                <li><a href="#">About Suit Up</a></li>
                <li><a href="#">About the costumes</a></li>
                <li><a href="#">About us</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h4>CONTACT US</h4>
            <p>suitupdevs69@gmail.com</p>
            <p>+63 9452985741</p>
            <p>Development Team</p>
            <div class="social-icons">
            <a href="#"><img src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png" alt="Instagram" width="24"></a>
            <a href="#"><img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg" alt="Facebook" width="24"></a>
            </div>
        </div>
    </div>
</footer>


</body>

