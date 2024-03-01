<?php

namespace App\Services;

use App\DataTransferObjects\GiphyData;

interface IGiphyService
{
    public function getById(string $id): mixed;
    public function getByQuery(GiphyData $data): mixed;
}
