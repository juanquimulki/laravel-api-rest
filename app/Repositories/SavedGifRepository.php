<?php

namespace App\Repositories;

use App\DataTransferObjects\SavedGifData;
use App\Models\SavedGif;

class SavedGifRepository {

    public function insert(SavedGifData $data): SavedGif
    {
        $savedGif = new SavedGif();

        $savedGif->gif_id  = $data->gif_id;
        $savedGif->alias   = $data->alias;
        $savedGif->user_id = $data->user_id;

        $savedGif->save();

        return $savedGif;
    }
}
