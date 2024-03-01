<?php

namespace App\DataTransferObjects;

class ServiceRequestData {

    public int    $user_id;
    public string $service;
    public string $body;
    public int    $http_status_code;
    public string $response;
    public string $origin;

    public function __construct(int $user_id, string $service, string $body, 
                                int $http_status_code, string $response, string $origin) {
        
        $this->user_id          = $user_id;
        $this->service          = $service;
        $this->body             = $body;
        $this->http_status_code = $http_status_code;
        $this->response         = $response;
        $this->origin           = $origin;
    }
}
