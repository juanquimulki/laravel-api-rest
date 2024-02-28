<?php

namespace App\DataTransferObjects;

use App\DataTransferObjects\GifSingleData;
use App\DataTransferObjects\MetaData;

class ResponseSingleData {

    private GifSingleData $data;
    private MetaData      $meta;

    public function __construct($response) {
        $this->data = new GifSingleData($response->data);
        $this->meta = new MetaData($response->meta);
    }

    public function toArray() {
        return [
            "data" => $this->data->toArray(),
            "meta" => $this->meta->toArray(),
        ];
    }
}
