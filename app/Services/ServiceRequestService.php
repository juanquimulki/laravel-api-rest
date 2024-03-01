<?php

namespace App\Services;

use App\DataTransferObjects\ServiceRequestData;
use App\Repositories\ServiceRequestRepository;

class ServiceRequestService implements IServiceRequestService {

    private ServiceRequestRepository $serviceRequestRepository;

    public function __construct(ServiceRequestRepository $serviceRequestRepository)
    {
        $this->serviceRequestRepository = $serviceRequestRepository;
    }

    public function save(ServiceRequestData $data)
    {
        return $this->serviceRequestRepository->insert($data);
    }
}
