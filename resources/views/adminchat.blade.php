<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Chat Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
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
    <a href="#"><i class="fas fa-comments"></i> Chat</a>
    <a href="{{ route('logout') }}" class="signout-btn mt-auto">Sign Out</a>
</div>

<div class="main-content">
    <h2>Admin-User Chat</h2>
    <div class="chat-container">
        <div class="chat-box" id="chat-box">
            <div class="message user-message">Hello Admin!</div>
            <div class="message admin-message">Hello! How can I assist you?</div>
        </div>
    </div>
    <div class="chat-input">
        <input type="text" class="form-control" id="chat-message" placeholder="Type a message...">
        <button class="btn btn-success" onclick="sendMessage()">Send</button>
    </div>
</div>

<script>
    function sendMessage() {
        let input = document.getElementById("chat-message");
        let message = input.value.trim();
        if (message !== "") {
            let chatBox = document.getElementById("chat-box");
            let newMessage = document.createElement("div");
            newMessage.classList.add("message", "admin-message");
            newMessage.textContent = message;
            chatBox.appendChild(newMessage);
            input.value = "";
            chatBox.scrollTop = chatBox.scrollHeight;
        }
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>