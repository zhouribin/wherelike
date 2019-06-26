<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OrderUpdate implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $groupCode;
    private $orderNo;
    public $data;

    /**
     * Create a new event instance.
     *
     * @param $groupCode
     * @param $orderNo
     * @param $data
     */
    public function __construct($groupCode, $orderNo, $data)
    {
        $this->groupCode = $groupCode;
        $this->orderNo = $orderNo;
        $this->data = $data;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('sec.channel.' . $this->groupCode . '.' . $this->orderNo);
    }
}
