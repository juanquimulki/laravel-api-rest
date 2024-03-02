<?php

namespace App\Services;

use App\DTO\Requests\SavedGifData;
use App\Repositories\SavedGifRepository;
use App\Models\SavedGif;

class SavedGifService implements ISavedGifService {

    private SavedGifRepository $savedGifRepository;

    public function __construct(SavedGifRepository $savedGifRepository)
    {
        $this->savedGifRepository = $savedGifRepository;
    }

    public function save(SavedGifData $data): SavedGif
    {
        return $this->savedGifRepository->insert($data);
    }
}
