<?php

namespace App\DTO\Requests;

class GiphyListData {

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
