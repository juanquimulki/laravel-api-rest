<?php

namespace App\DataTransferObjects;

class SavedGifData {

    public string $gif_id;
    public string $alias;
    public int    $user_id;

    public function __construct(string $gif_id, string $alias, int $user_id)
    {
        $this->gif_id  = $gif_id;
        $this->alias   = $alias;
        $this->user_id = $user_id;
    }
}
