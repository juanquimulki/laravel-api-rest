<?php

namespace App\Services;

use App\DTO\Requests\ServiceRequestData;

interface _IServiceRequestService
{
    public function save(ServiceRequestData $data): void;
}
