<?php

namespace App\DataTransferObjects;

class ResponseData {

    protected $data;
    private   MetaData $meta;
    protected PaginationData $pagination;

    public function __construct($response) {
        $this->meta = new MetaData($response->meta);
    }

    public function toArray() {
        return [
            "data"       => $this->data->toArray(),
            "meta"       => $this->meta->toArray(),
            "pagination" => isset($this->pagination) ? $this->pagination->toArray() : null,
        ];
    }
}
