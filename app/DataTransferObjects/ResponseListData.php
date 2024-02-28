<?php

namespace App\DataTransferObjects;

class ResponseListData extends ResponseData {

    public function __construct($response) {
        parent::__construct($response);
        
        $this->data       = new GifListData($response->data);
        $this->pagination = new PaginationData($response->pagination);
    }
}
