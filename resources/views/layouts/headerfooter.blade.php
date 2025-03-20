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
<body>

    <!-- Promo Banner -->
    <div class="promo-banner text-center p-2 bg-warning">
        Sale is on! 25% off sitewide using TEE25 at checkout
    </div>

    <!-- Navbar -->
    @include('partials.navbar')

    <div class="container-fluid bg-light mt-5 w-100">
        @yield('content')
    </div>

    <!-- Footer -->
    @include('partials.footer2')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        // ✅ Function to update cart count globally
        function updateCartCount() {
            $.ajax({
                url: '{{ route("cart.count.ajax") }}',
                method: 'GET',
                success: function (data) {
                    $('#cart-count').text(data.count);  // Update the cart count
                },
                error: function () {
                    console.error('Failed to fetch cart count.');
                }
            });
        }

        // ✅ Trigger cart count update on cart actions
        $(document).on('submit', '.add-to-cart-form, .remove-from-cart-form', function (e) {
            e.preventDefault();

            let form = $(this);
            let formData = form.serialize();

            $.ajax({
                url: form.attr('action'),
                method: form.attr('method'),
                data: formData,
                success: function (response) {
                    if (response.success) {
                        updateCartCount();  // Update cart count globally
                        alert(response.message);
                    } else {
                        alert(response.message);
                    }
                },
                error: function () {
                    alert('Failed to update cart.');
                }
            });
        });

        // ✅ Automatically update cart count on page load
        updateCartCount();
    });
</script>

</body>
</html>
