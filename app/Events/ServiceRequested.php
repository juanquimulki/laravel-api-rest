<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ServiceRequested
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public int    $user_id;
    public string $service;
    public string $body;
    public int    $http_status_code;
    public string $response;
    public string $origin;

    /**
     * Create a new event instance.
     */
    public function __construct(int $user_id, string $service, string $body, 
        int $http_status_code, string $response, string $origin)
    {
        $this->user_id          = $user_id;
        $this->service          = $service;
        $this->body             = $body;
        $this->http_status_code = $http_status_code;
        $this->response         = $response;
        $this->origin           = $origin;
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
