<?php

namespace App\DTO\Responses;

class GifListData {

    private array $gifs;

    public function __construct($data)
    {
        foreach ($data as $gif) {
            $this->gifs[] = new GifSingleData($gif);
        };
    }

    public function toArray(): array
    {
        $result = [];
        foreach ($this->gifs as $gif) {
            $result[] = $gif->toArray();
        };
        return $result;
    }
}
