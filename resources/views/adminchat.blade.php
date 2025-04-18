<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Chat Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.11.3/echo.iife.js"></script>
<script>
    Pusher.logToConsole = false;

    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: "{{ env('PUSHER_APP_KEY') }}",
        cluster: "{{ env('PUSHER_APP_CLUSTER') }}",
        forceTLS: true,
        authEndpoint: '/broadcasting/auth',
        auth: {
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }
    });
</script>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #E8E6F1;
            padding: 0;
            display: flex;
        }
        .sidebar {
            width: 250px;
            background: #fff;
            padding: 20px;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }
        .sidebar a {
            display: block;
            padding: 12px;
            color: #333;
            text-decoration: none;
            margin: 10px 0;
            background: #f8f9fa;
            border-radius: 12px;
            text-align: center;
            transition: background 0.3s ease-in-out, transform 0.2s ease-in-out;
        }
        .sidebar a:hover {
            background: #10eb4b;
            color: white;
            transform: scale(1.05);
        }
        .main-content {
            flex: 1;
            padding: 20px;
        }
        .chat-container {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            height: 60vh;
            overflow-y: auto;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        .chat-box {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .message {
            padding: 10px;
            border-radius: 12px;
            max-width: 70%;
        }
        .admin-message {
            background: #10eb4b;
            color: white;
            align-self: flex-end;
        }
        .user-message {
            background: #f1f1f1;
            color: #333;
            align-self: flex-start;
        }
        .chat-input {
            margin-top: 10px;
            display: flex;
            gap: 10px;
        }
    </style>
</head>
<body>
<div class="sidebar">
    <h2>Admin Panel</h2>
    <a href="#"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    <a href="#"><i class="fas fa-box"></i> Orders</a>
    <a href="#"><i class="fas fa-shopping-cart"></i> Products</a>
    <a href="{{ route('admin.chat') }}"><i class="fas fa-comments"></i> Chat</a>
    <a href="{{ route('logout') }}" class="signout-btn mt-auto">Sign Out</a>
</div>

<div class="main-content">
    <h2>Admin-User Chat</h2>
    <div class="row">
    <div class="col-md-4">
        <div class="list-group">
            @foreach ($userList as $user)
                <button class="list-group-item list-group-item-action" onclick="loadChat({{ $user->id }}, '{{ $user->name }}')">
                    {{ $user->name }}
                </button>
            @endforeach
        </div>
    </div>
    <div class="col-md-8">
        <h4 id="chat-with-title">Select a user to start</h4>
        <div class="chat-container">
            <div class="chat-box" id="chat-box"></div>
        </div>
        <div class="chat-input mt-2">
            <input type="text" class="form-control" id="chat-message" placeholder="Type a message...">
            <button class="btn btn-success" onclick="sendMessage()">Send</button>
        </div>
    </div>
</div>

</div>

<script>
    let selectedUserId = null;
    let chatChannel = null;
        console.log(`Subscribing to chat-channel-${userId}`);

    function loadChat(userId, userName) {
        selectedUserId = userId;
        document.getElementById("chat-with-title").innerText = "Chat with " + userName;

        if (chatChannel) {
        Echo.leave(`private-chat-channel-${userId}`);
    }

        // Subscribe to real-time channel for this user
        chatChannel = Echo.private(`chat-channel-${userId}`) // 👈 subscribe to user’s channel
        .listen('.message-received', (e) => {
            console.log(`Subscribing to chat-channel-${userId}`);

            if (parseInt(e.message.sender_id) === userId) {
                const chatBox = document.getElementById("chat-box");

                const wrapper = document.createElement("div");
                wrapper.classList.add("d-flex", "justify-content-start");

                const messageDiv = document.createElement("div");
                messageDiv.classList.add("message", "user-message");
                messageDiv.innerText = e.message.message;

                wrapper.appendChild(messageDiv);
                chatBox.appendChild(wrapper);
                chatBox.scrollTop = chatBox.scrollHeight;
            }
        });
        
        // Load previous messages
        fetch(`/admin/chat/user/${userId}`)
            .then(response => response.json())
            .then(messages => {
                const chatBox = document.getElementById("chat-box");
                chatBox.innerHTML = '';
                messages.forEach(msg => {
                    const isAdmin = msg.sender_id == 1; // Use loose comparison
                    const wrapper = document.createElement("div");
                    wrapper.classList.add("d-flex", isAdmin ? "justify-content-end" : "justify-content-start");

                    const messageDiv = document.createElement("div");
                    messageDiv.classList.add("message", isAdmin ? "admin-message" : "user-message");
                    messageDiv.innerText = msg.message;

                    wrapper.appendChild(messageDiv);
                    chatBox.appendChild(wrapper);
                });
                chatBox.scrollTop = chatBox.scrollHeight;
            });
    }

    function sendMessage() {
        const input = document.getElementById("chat-message");
        const message = input.value.trim();
        if (!message || selectedUserId === null) return;

        fetch(`/admin/chat/user/${selectedUserId}`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ message })
        })
        .then(response => response.json())
        .then(data => {
            const chatBox = document.getElementById("chat-box");

            const wrapper = document.createElement("div");
            wrapper.classList.add("d-flex", "justify-content-end");

            const msgDiv = document.createElement("div");
            msgDiv.classList.add("message", "admin-message");
            msgDiv.innerText = data.message;

            wrapper.appendChild(msgDiv);
            chatBox.appendChild(wrapper);
            chatBox.scrollTop = chatBox.scrollHeight;
            input.value = '';
        });
    }
</script>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>