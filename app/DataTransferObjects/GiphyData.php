<?php

namespace App\DataTransferObjects;

class GiphyData {

    public string $query;
    public ?int   $limit;
    public ?int   $offset;

    public function __construct(string $query, ?int $limit = null, ?int $offset = null)
    {
        $this->query  = $query;
        $this->limit  = $limit;
        $this->offset = $offset;
    }
}
