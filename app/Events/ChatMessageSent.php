<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatMessageSent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct($message)
    {
        // Only pass safe, serializable values
        $this->message = [
            'id' => $message->id,
            'message' => $message->message,
            'sender_id' => $message->sender_id,
            'receiver_id' => $message->receiver_id,
            'created_at' => $message->created_at->toDateTimeString(),
            'sender_name' => optional($message->sender)->name ?? 'Unknown'
        ];
    }

    public function broadcastOn()
    {
        return [
            new PrivateChannel('chat-channel-' . $this->message['receiver_id']),
        ];
    }

    public function broadcastAs()
    {
        return 'message-received';
    }
}
