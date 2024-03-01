<?php

namespace App\DataTransferObjects;

class GifListData {

    private array $gifs;

    public function __construct($data)
    {
        foreach ($data as $gif) {
            $this->gifs[] = (new GifSingleData($gif))->toArray();
        };
    }

    public function toArray(): array
    {
        return $this->gifs;
    }
}
