<?php

namespace App\Services;

use App\DataTransferObjects\GiphyData;

interface IGiphyService
{
    public function getById(string $id): object;
    public function getByQuery(GiphyData $data): object;
}
