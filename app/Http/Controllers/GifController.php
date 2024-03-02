<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\IGiphyService;
use App\DTO\Requests\GiphyListData;

class GifController extends Controller
{
    private IGiphyService $giphyService;

    public function __construct(IGiphyService $giphyService)
    {
        $this->giphyService = $giphyService;
    }

    public function getById(Request $request): JsonResponse
    {
        $request->validate([
            'id' => 'required|string', // El 'id' es alfanumérico
        ]);

        $response = $this->giphyService->getById($request->id);

        return response()->json($response->toArray());
    }

    public function getByQuery(Request $request): JsonResponse
    {
        $request->validate([
            'q'      => 'required|string',
            'limit'  => 'integer',
            'offset' => 'integer'
        ]);

        $giphyData = new GiphyListData($request->q, $request->limit, $request->offset);
        $response = $this->giphyService->getByQuery($giphyData);

        return response()->json($response->toArray());
    }
}
