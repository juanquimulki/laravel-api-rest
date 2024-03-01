<?php

namespace App\Services;

use App\DataTransferObjects\SavedGifData;
use App\Models\SavedGif;
use App\Repositories\SavedGifRepository;

class SavedGifService implements ISavedGifService {

    private SavedGifRepository $savedGifRepository;

    public function __construct(SavedGifRepository $savedGifRepository)
    {
        $this->savedGifRepository = $savedGifRepository;
    }

    public function save(SavedGifData $data)
    {
        return $this->savedGifRepository->insert($data);
    }
}
