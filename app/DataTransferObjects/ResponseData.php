<?php

namespace App\DataTransferObjects;

class ResponseData {

    protected $data;
    private   MetaData $meta;
    protected ?PaginationData $pagination;

    public function __construct($response) {
        $this->meta = new MetaData($response->meta);
    }

    public function toArray() {
        $response = [
            "data"       => $this->data->toArray(),
            "meta"       => $this->meta->toArray(),
        ];

        if (isset($this->pagination)) {
            $response["pagination"] = $this->pagination->toArray();
        }

        return $response;
    }
}
