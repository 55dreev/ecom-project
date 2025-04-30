<?php
// routes/channels.php

use Illuminate\Support\Facades\Broadcast;
use App\Models\Order;
use App\Models\User;

Broadcast::channel('chat-channel-{userId}', function ($user, $userId) {
    return (int) $user->id === (int) $userId;
});

Broadcast::channel('orders.{orderId}', function (User $user, $orderId) {
    return (int)$user->id === Order::findOrNew($orderId)->user_id;
});
