<?php

namespace App\Events;

use App\Models\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

use Illuminate\Broadcasting\PrivateChannel;

class OrderUpdated implements ShouldBroadcastNow

{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('orders.' . $this->order->id);
    }
public function broadcastWith(): array
{
    return [
        'order_id' => $this->order->id,   // <-- include order id
        'status' => $this->order->status,
    ];
}

    public function broadcastAs(): string
    {
        return 'OrderUpdated';
    }
}
