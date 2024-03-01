<?php

namespace App\Services;

use App\DataTransferObjects\ServiceRequestData;

interface IServiceRequestService
{
    public function save(ServiceRequestData $data);
}
