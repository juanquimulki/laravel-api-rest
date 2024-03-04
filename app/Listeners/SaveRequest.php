<?php

namespace App\Listeners;

use App\Events\ServiceRequested;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Services\_IServiceRequestService as IServiceRequestService;

class SaveRequest
{

    private IServiceRequestService $serviceRequestService;

    /**
     * Create the event listener.
     */
    public function __construct(IServiceRequestService $serviceRequestService)
    {
        $this->serviceRequestService = $serviceRequestService;
    }

    /**
     * Handle the event.
     */
    public function handle(ServiceRequested $event): void
    {
        $this->serviceRequestService->save($event->data);
    }
}
