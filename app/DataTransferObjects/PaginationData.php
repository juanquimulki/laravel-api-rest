<?php

namespace App\DataTransferObjects;

class PaginationData {

    private int $total_count;
    private int $count;
    private int $offset;

    public function __construct($data)
    {
        $this->total_count = $data->total_count;
        $this->count       = $data->count;
        $this->offset      = $data->offset;
    }

    public function toArray(): array
    {
        return [
            "total_count" => $this->total_count,
            "count"       => $this->count,
            "offset"      => $this->offset,
        ];
    }
}
