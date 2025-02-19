<head>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        /* Navbar Styling */
        .header {
            position: fixed;
            top: 0;
            left: -10px;
            width: 100%;
            background-color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }
        
        .logo {
            font-size: 24px;
            font-weight: bold;
        }

        .navbar {
            left: -60px;
            display: flex;
            list-style: none;
            gap: 10px;
            padding: 0;
            margin-left: -70px; /* Moves the navbar 20px to the left */
        }

        .navbar a {
            text-decoration: none;
            color: black;
            font-size: 18px;
            padding: 10px;
            transition: 0.3s;
        }

        .navbar a:hover {
            background-color: rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .cart-login {
    display: flex;
    align-items: center;
    gap: 15px;
    position: relative; /* Ensure left positioning works */
    left: -50px; /* Adjust value to move it more or less to the left */
}
        .cart-login p {
            margin: 0;
        }

        .cart-login button {
            background-color: black;
            color: white;
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 5px;
        }

        .cart-login button:hover {
            background-color: gray;
        }

        main {
            margin-top: 80px; /* Ensure content doesn't overlap with fixed navbar */
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="logo">SUIT UP!</div>
        <nav>
            <ul class="navbar">
                <li><a href="#hero">Home</a></li>
                <li><a href="#why-suit-up">FAQs</a></li>
                <li><a href="#about-us">About Us</a></li>
            </ul>
        </nav>
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
