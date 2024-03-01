<?php

namespace App\Listeners;

use App\Events\ServiceRequested;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Models\ServiceRequest;

class SaveRequest
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ServiceRequested $event): void
    {
        $sR = new ServiceRequest();

        $sR->user_id          = $event->data->user_id;
        $sR->service          = $event->data->service;
        $sR->body             = $event->data->body;
        $sR->http_status_code = $event->data->http_status_code;
        $sR->response         = $event->data->response;
        $sR->origin           = $event->data->origin;

        $sR->save();
    }
}
