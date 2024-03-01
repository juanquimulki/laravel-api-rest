<?php

namespace App\Repositories;

use App\DataTransferObjects\ServiceRequestData;
use App\Models\ServiceRequest;

class ServiceRequestRepository {

    public function insert(ServiceRequestData $data)
    {
        $sR = new ServiceRequest();

        $sR->user_id          = $data->user_id;
        $sR->service          = $data->service;
        $sR->body             = $data->body;
        $sR->http_status_code = $data->http_status_code;
        $sR->response         = $data->response;
        $sR->origin           = $data->origin;

        $sR->save();
    }
}
