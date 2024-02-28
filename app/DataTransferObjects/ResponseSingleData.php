<?php

namespace App\DataTransferObjects;

class ResponseSingleData extends ResponseData {

    public function __construct($response) {
        parent::__construct($response);

        $this->data       = new GifSingleData($response->data);
        $this->pagination = null;
    }
}
