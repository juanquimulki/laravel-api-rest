<?php

namespace App\DataTransferObjects;

class MetaData {

    private int    $status;
    private string $msg;
    private string $response_id;

    public function __construct($data)
    {
        $this->status      = $data->status;
        $this->msg         = $data->msg;
        $this->response_id = $data->response_id;
    }

    public function toArray(): array
    {
        return [
            "status"      => $this->status,
            "msg"         => $this->msg,
            "response_id" => $this->response_id,
        ];
    }
}
