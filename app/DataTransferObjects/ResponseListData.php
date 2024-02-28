<?php

namespace App\DataTransferObjects;

use App\DataTransferObjects\GifListData;
use App\DataTransferObjects\MetaData;
use App\DataTransferObjects\PaginationData;

class ResponseListData {

    private GifListData  $data;
    private MetaData       $meta;
    private PaginationData $pagination;

    public function __construct($response) {
        $this->data = new GifListData($response->data);
        $this->meta = new MetaData($response->meta);
        $this->pagination = new PaginationData($response->pagination);
    }

    public function toArray() {
        return [
            "data" => $this->data->toArray(),
            "meta" => $this->meta->toArray(),
            "pagination" => $this->pagination->toArray(),
        ];
    }
}
