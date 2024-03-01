<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use App\DataTransferObjects\ServiceRequestData;

class ServiceRequested
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public ServiceRequestData $data;

    /**
     * Create a new event instance.
     */
    public function __construct(ServiceRequestData $serviceRequestData)
    {
        $this->data = $serviceRequestData;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
