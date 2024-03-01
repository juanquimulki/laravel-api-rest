<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\IGiphyService;
use App\DataTransferObjects\GiphyData;
use App\DataTransferObjects\GifSingleData;
use App\DataTransferObjects\GifListData;
use App\DataTransferObjects\MetaData;
use App\DataTransferObjects\PaginationData;

class GifController extends Controller
{
    private IGiphyService $giphyService;

    public function __construct(IGiphyService $giphyService)
    {
        $this->giphyService = $giphyService;
    }

    public function getById(Request $request) {
        $request->validate([
            'id' => 'required|string', // El 'id' es alfanumérico
        ]);

        $response = $this->giphyService->getById($request->id);

        return response()->json([
            "data"       => (new GifSingleData($response->data))->toArray(),
            "meta"       => (new MetaData($response->meta))->toArray(),
        ]);
    }

    public function getByQuery(Request $request) {
        $request->validate([
            'q'      => 'required|string',
            'limit'  => 'integer',
            'offset' => 'integer'
        ]);

        $giphyData = new GiphyData($request->q, $request->limit, $request->offset);
        $response = $this->giphyService->getByQuery($giphyData);

        return response()->json([
            "data"       => (new GifListData($response->data))->toArray(),
            "meta"       => (new MetaData($response->meta))->toArray(),
            "pagination" => (new PaginationData($response->pagination))->toArray(),
        ]);
    }
}
