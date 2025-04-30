<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Your Page Title</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <style>
        /* Floating Chat Button Style */
        .chat-float {
            position: fixed;
            bottom: 30px;
            right: 30px;
            height: 60px;
            width: 60px;
            font-size: 28px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
            z-index: 9999;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('homepage') }}" id="homeLink">Suit Up</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <a id="categoriesLink" href="{{ route('categoriespage') }}" class="nav-link">Costumes</a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">More</a>
                    </li>
                </ul>
            </div>

            <div class="nav-icons d-flex align-items-center">
                <!-- Account Icon -->
                <a href="{{ route('account.edit') }}" class="me-3">
                    <i class="bi bi-person"></i>
                </a>
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

    <!-- Floating Chat Button (shown if the user is authenticated) -->
    @if(auth()->check())
        <button id="chatButton" class="btn btn-primary rounded-circle chat-float">
            <i class="bi bi-chat-dots"></i>
            <span id="chatBadge"
          class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
          style="font-size: 12px; display: none;">0</span>
        </button>
    @endif

    <!-- Chat Modal -->
    <div class="modal fade" id="chatModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-end">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Chat with Admin</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="chatContent" style="height:400px; overflow:auto;">
                    <!-- Messages will load here -->
                    <div id="scroll-anchor"></div>
                </div>
                <div class="modal-footer">
                    <input type="text" id="chatMessage" class="form-control" placeholder="Type your message...">
                    <button id="sendBtn" class="btn btn-primary">Send</button>
                </div>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.11.3/echo.iife.js"></script>

<script>
    let isChatOpen = false;
    Pusher.logToConsole = true; // ✅ Optional for debugging
    function scrollToBottom() {
    requestAnimationFrame(() => {
        const anchor = document.getElementById("scroll-anchor");
        if (anchor) {
            anchor.scrollIntoView({ behavior: 'smooth' });
        }
    });
}


    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: '{{ config('broadcasting.connections.pusher.key') }}',
        cluster: '{{ config('broadcasting.connections.pusher.options.cluster') }}',
        forceTLS: true,
        encrypted: true,
        enabledTransports: ['ws', 'wss'],
        authEndpoint: '/broadcasting/auth',
        auth: {
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }
    });

    // Create modal instance
    const chatModalInstance = new bootstrap.Modal(document.getElementById('chatModal'));

    // When chat button is clicked
    document.getElementById('chatButton').addEventListener('click', () => {
    chatModalInstance.show();
    isChatOpen = true;

    // Reset badge
    const chatBadge = document.getElementById('chatBadge');
    chatBadge.innerText = '0';
    chatBadge.style.display = 'none';

    fetch("{{ route('chat.fetch') }}")
    .then(response => response.json())
    .then(messages => {
        console.log("Messages loaded from DB:", messages); // ✅ debug log
        const chatContent = document.getElementById('chatContent');
        chatContent.innerHTML = '';
messages.forEach(msg => {
    const isUser = msg.sender_id === {{ auth()->id() }};
    const align = isUser ? 'text-end' : 'text-start';
    const sender = isUser ? 'You' : 'Admin';

    const messageDiv = document.createElement("div");
    messageDiv.className = `${align} mb-2`;
    messageDiv.innerHTML = `<strong>${sender}:</strong> ${msg.message}`;
    chatContent.appendChild(messageDiv);
});

// 🟢 Re-append the anchor so it's still there
const scrollAnchor = document.createElement('div');
scrollAnchor.id = 'scroll-anchor';
chatContent.appendChild(scrollAnchor);

// Now scroll smoothly to it
setTimeout(scrollToBottom, 300); // 300ms matches Bootstrap modal animation


    })
    .catch(err => console.error("Fetch error:", err));
});

document.getElementById('chatModal').addEventListener('hidden.bs.modal', () => {
    isChatOpen = false;
});


window.Echo.private(`chat-channel-{{ auth()->id() }}`)
    .listen('.message-received', (e) => {
        console.log('🔥 Message received!', e);
        if (e.message.sender_id === {{ auth()->id() }}) return;

        const chatContent = document.getElementById('chatContent');

        // Add the message to chat UI if open
        if (isChatOpen) {
    const newMessage = document.createElement("div");
    newMessage.className = "text-start mb-2";
    newMessage.innerHTML = `<strong>Admin:</strong> ${e.message.message}`;
    chatContent.appendChild(newMessage);

    // Move the anchor to the very end
    const anchor = document.getElementById("scroll-anchor");
    chatContent.appendChild(anchor);

    setTimeout(scrollToBottom, 300);
}

 else {
            // Show badge count if chat is closed
            const chatBadge = document.getElementById('chatBadge');
            let count = parseInt(chatBadge.innerText || '0');
            count++;
            chatBadge.innerText = count;
            chatBadge.style.display = 'inline-block';
        }
    });



    // Send message to backend
    document.getElementById('sendBtn').onclick = () => {
        const messageInput = document.getElementById('chatMessage');
        const message = messageInput.value.trim();
        if (!message) return;

        fetch("{{ route('chat.send') }}", {
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            method: "POST",
            body: JSON.stringify({ message: message })
        });
        const youMsg = document.createElement("div");
youMsg.className = "text-end mb-2";
youMsg.innerHTML = `<strong>You:</strong> ${message}`;
chatContent.appendChild(youMsg);

// Move anchor again and scroll
chatContent.appendChild(document.getElementById("scroll-anchor"));
setTimeout(scrollToBottom, 300);


        messageInput.value = '';
        document.getElementById('chatContent').scrollTop = document.getElementById('chatContent').scrollHeight;
    };

    document.getElementById('categoriesLink').addEventListener('click', function(e) {
  e.preventDefault();
  const url = this.href;

  // Call your badge update and wait for it to finish
  fetch('{{ route("cart.count") }}', {
    headers: { 'X-Requested-With': 'XMLHttpRequest' },
    cache: 'no-store'
  })
  .then(res => res.json())
  .then(json => {
    const badge = document.getElementById('cart-count');
    if (badge && Number.isInteger(json.cart_count)) {
      badge.textContent = json.cart_count;
    }
  })
  .catch(console.error)
  .finally(() => {
    // Now that we've updated (or at least attempted), navigate
    window.location.href = url;
  });
});


</script>


</body>
</html>
