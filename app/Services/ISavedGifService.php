<?php

namespace App\Services;

use App\DataTransferObjects\SavedGifData;

interface ISavedGifService
{
    public function save(SavedGifData $data);
}
