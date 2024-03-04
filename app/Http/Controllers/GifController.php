<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\_IGiphyService as IGiphyService;
use App\DTO\Requests\GiphyListData;
use App\Classes\StatusCodes;

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

        try {
            $response = $this->giphyService->getById($request->id);
            
            return response()->json($response->toArray());
        } catch (\Exception $e) {
            return response()->json(["message"=>$e->getMessage()], StatusCodes::$SERVER_ERROR);
        }
        
    }

    public function getByQuery(Request $request): JsonResponse
    {
        $request->validate([
            'q'      => 'required|string',
            'limit'  => 'integer',
            'offset' => 'integer'
        ]);

        $giphyData = new GiphyListData($request->q, $request->limit, $request->offset);
        try {
            $response = $this->giphyService->getByQuery($giphyData);
            return response()->json($response->toArray());
        } catch (\Exception $e) {
            return response()->json(["message"=>$e->getMessage()], StatusCodes::$SERVER_ERROR);
        }
    }
}
