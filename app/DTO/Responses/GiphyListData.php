<?php

namespace App\DTO\Responses;

class GiphyListData {

    private GifListData    $gifs;
    private MetaData       $meta;
    private PaginationData $pagination;

    public function __construct(GifListData $gifs, MetaData $meta, PaginationData $pagination)
    {
        $this->gif        = $gifs;
        $this->meta       = $meta;
        $this->pagination = $pagination;
    }

    public function toArray(): array
    {
        return [
            "data"       => $this->gif->toArray(),
            "meta"       => $this->meta->toArray(),
            "pagination" => $this->pagination->toArray(),
        ];
    }
}
