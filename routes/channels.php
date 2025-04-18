<?php
// routes/channels.php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat-channel-{userId}', function ($user, $userId) {
    return (int) $user->id === (int) $userId;
});

