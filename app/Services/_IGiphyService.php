<?php

namespace App\Services;

use App\DTO\Responses\GiphySingleData;
use App\DTO\Requests\GiphyListData as GiphyListRequest;
use App\DTO\Responses\GiphyListData as GiphyListResponse;

interface _IGiphyService
{
    public function getById(string $id): GiphySingleData;
    public function getByQuery(GiphyListRequest $data): GiphyListResponse;
}
