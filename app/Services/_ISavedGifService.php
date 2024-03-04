<?php

namespace App\Services;

use App\DTO\Requests\SavedGifData;
use App\Models\SavedGif;

interface _ISavedGifService
{
    public function save(SavedGifData $data): SavedGif;
}
