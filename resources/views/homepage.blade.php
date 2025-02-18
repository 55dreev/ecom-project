<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suit Up!</title>
    <link rel="stylesheet" href="css/homepage.css">
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

<section class="hero">
    <img src="{{ asset('images/superherobg.jpg') }}" alt="Superhero Costumes" class="hero-image">
    <div class="search-box">
        <p>What would you like to browse?</p>
        <div class="search-container">
            <i class="fas fa-search"></i>
            <input type="text" id="searchInput" placeholder="Search...">
            <button>Search</button>
        </div>
    </div>
</section>

<section class="theme-grid" id="themeGrid">
    <div class="theme" data-theme="halloween">
        <img src="{{ asset('images/halloween.jpg') }}" alt="Halloween">
        <p>Halloween</p>
    </div>
    <div class="theme" data-theme="christmas">
        <img src="{{ asset('images/christmas.jpg') }}" alt="Christmas">
        <p>Christmas</p>
    </div>
    <div class="theme" data-theme="cartoon">
        <img src="{{ asset('images/cartoon.jpg') }}" alt="Cartoons">
        <p>Cartoons</p>
    </div>
    <div class="theme" data-theme="medieval">
        <img src="{{ asset('images/medieval.jpg') }}" alt="Medieval">
        <p>Medieval</p>
    </div>
    <div class="theme" data-theme="animal">
        <img src="{{ asset('images/animal.jpg') }}" alt="Animal">
        <p>Animal</p>
    </div>
    <div class="theme" data-theme="career">
        <img src="{{ asset('images/career.jpg') }}" alt="Career">
        <p>Career</p>
    </div>
    <div class="theme" data-theme="historical">
        <img src="{{ asset('images/historical.jpg') }}" alt="Historical">
        <p>Historical</p>
    </div>
    <div class="theme" data-theme="superhero">
        <img src="{{ asset('images/superhero.jpg') }}" alt="Superheroes">
        <p>Superheroes</p>
    </div>
</section>

<section class="why-suit-up">
    <h2>Why Suit Up?</h2>
    <ul>
        <li>Wide Selection – A diverse range of costumes for all occasions, from Halloween to themed parties.</li>
        <li>High-Quality Materials – Durable and comfortable costumes designed to last.</li>
        <li>Affordable Prices – Competitive pricing with great deals and discounts.</li>
        <li>Customization Options – Unique, tailor-made costumes to fit your needs.</li>
        <li>Fast & Reliable Shipping – Get your costume delivered on time, wherever you are.</li>
        <li>Easy Returns & Exchanges – Hassle-free return policies for a stress-free experience.</li>
        <li>Customer Support – Dedicated support team to help with sizing, orders, and more.</li>
    </ul>
</section>

<section class="about-us">
    <h3>About Us</h3>
    <ul>
        <li>Finding the perfect costume should be fun and hassle-free, and that’s exactly what our website offers! 
            We provide a wide selection of costumes for every occasion, whether it’s Halloween, cosplay, or a themed party. 
            Our costumes are made from high-quality materials to ensure durability and comfort, all at affordable prices. 
            Need something unique? We offer customization options to bring your vision to life. With fast and reliable shipping, 
            you’ll never have to worry about last-minute costume needs. Plus, our easy returns and exchanges mean you can shop with confidence. 
            If you ever need assistance, our friendly customer support team is here to help. Suit up with us and make your next event unforgettable!</li>
    </ul>
</section>

<footer>
    <div class="column">
        <h3>INFO</h3>
        <ul>
            <li>Location</li>
            <li>Costumes</li>
            <li>Pricing</li>
            <li>Payment Methods</li>
            <li>Delivery</li>
            <li>FAQ's</li>
        </ul>
    </div>
    <div class="column">
        <h3>CONTACT US</h3>
        <ul>
            <li>Email: suitupdevs98@gmail.com</li>
            <li>Phone: +63 9452958741</li>
        </ul>
    </div>
</footer>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.getElementById("searchInput");
    const themes = document.querySelectorAll(".theme");
    const themeGrid = document.getElementById("themeGrid");

    // Ensure all themes are visible initially
    themes.forEach(theme => {
        theme.style.display = "block";
    });

    searchInput.addEventListener("input", function() {
        const query = searchInput.value.toLowerCase().trim();
        let hasResults = false;

        themes.forEach(theme => {
            const themeName = theme.getAttribute("data-theme").toLowerCase();
            if (themeName.includes(query)) {
                theme.style.display = "block";
                hasResults = true;
            } else {
                theme.style.display = "none";
            }
        });

        // Apply animation to results
        if (hasResults) {
            themeGrid.classList.add("visible");
        } else {
            themeGrid.classList.remove("visible");
        }
    });
});

</script>


</body>
</html>
