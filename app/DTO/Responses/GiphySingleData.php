<?php

namespace App\DTO\Responses;

class GiphySingleData {

    private GifSingleData $gif;
    private MetaData      $meta;

    public function __construct(GifSingleData $gif, MetaData $meta)
    {
        $this->gif  = $gif;
        $this->meta = $meta;
    }

    public function toArray(): array
    {
        return [
            "data" => $this->gif->toArray(),
            "meta" => $this->meta->toArray(),
        ];
    }
}
