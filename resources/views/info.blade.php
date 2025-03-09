@extends('layouts.headerfooter')

@section('title', 'Information - T Shop')

@section('content')
<head>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            if (window.location.hash) {
                const target = document.querySelector(window.location.hash);
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }
        });
    </script>
</head>

<div class="container my-5">
    <h1 class="text-center fw-bold">Information Center</h1>
    
    <!-- FAQ Section -->
    <div id="faq" class="mt-5">
        <h2>Frequently Asked Questions (FAQ)</h2>
        <p><strong>Q: How do I place an order?</strong></p>
        <p>A: Simply browse our collection, add items to your cart, and proceed to checkout.</p>

        <p><strong>Q: What are the available payment methods?</strong></p>
        <p>A: We accept GCash, Cash on Delivery (COD), and Bank Transfers (Landbank, BPI, etc.).</p>

        <p><strong>Q: How long does shipping take?</strong></p>
        <p>A: Orders are typically delivered within 3-7 business days, depending on location.</p>
    </div>

    <!-- Store Policy Section -->
    <div id="store-policy" class="mt-5">
        <h2>Store Policy</h2>
        <p>We strive to provide high-quality costumes and excellent customer service. Please review our policies:</p>
        <ul>
            <li>All sales are final unless the item is defective.</li>
            <li>Costumes must be unworn and in original packaging for any return requests.</li>
            <li>We reserve the right to refuse service to anyone violating our policies.</li>
        </ul>
    </div>

    <!-- Shipping and Returns Section -->
    <div id="shipping-returns" class="mt-5">
        <h2>Shipping & Returns</h2>
        <p><strong>Shipping:</strong> We ship nationwide with standard delivery taking 3-7 business days.</p>
        <p><strong>Returns:</strong> Returns are accepted within 7 days if the item is defective. Contact support to process returns.</p>
    </div>

    <!-- Payment Methods Section -->
    <div id="payment-methods" class="mt-5">
        <h2>Payment Methods</h2>
        <p>We offer flexible payment options:</p>
        <ul>
            <li><strong>GCash</strong> - Pay instantly via your GCash account.</li>
            <li><strong>Cash on Delivery (COD)</strong> - Pay upon receiving your order.</li>
            <li><strong>Bank Transfer</strong> - Available for Landbank, BPI, and other major banks.</li>
        </ul>
    </div>

    <!-- Subscribe Section -->
   <!-- Subscribe Section -->
<div id="subscribe" class="mt-5 text-center">
    <h2>Subscribe to Our Newsletter</h2>
    <p>Stay updated with the latest deals, new arrivals, and exclusive offers!</p>
</div>

@endsection
