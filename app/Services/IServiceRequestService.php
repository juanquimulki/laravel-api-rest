<?php

namespace App\Services;

use App\DTO\Requests\ServiceRequestData;

interface IServiceRequestService
{
    public function save(ServiceRequestData $data): void;
}
