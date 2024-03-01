<?php

namespace App\Services;

use App\DataTransferObjects\SavedGifData;
use App\Models\SavedGif;

interface ISavedGifService
{
    public function save(SavedGifData $data): SavedGif;
}
