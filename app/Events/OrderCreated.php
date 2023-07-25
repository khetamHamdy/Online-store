<?php

namespace App\Events;

use App\Models\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderCreated  implements ShouldBroadcast {
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $order;

    /**
    * Create a new event instance.
    *
    * @return void
    */

    public function __construct( Order $order ) {
        $this->order = $order;

    }

    /**
    * Get the channels the event should broadcast on.
    *
    * @return \Illuminate\Broadcasting\Channel|array
    */

    public function broadcastOn() {
        return new PrivateChannel( 'channel-Order-Create' );
    }

    //   public  function broadcastWith()
    // {
    //         return [
    //             'order'=>$this->order,
    //             'countOrders'=>Order::count(),
    // ];
    //     }

    //    public function broadcastAs()
    // {
    //         return 'Order-created';
    //    }
}
