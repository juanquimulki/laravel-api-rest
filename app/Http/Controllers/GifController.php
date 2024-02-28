<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\DataTransferObjects\GifSingleData;
use App\DataTransferObjects\GifListData;
use App\DataTransferObjects\MetaData;
use App\DataTransferObjects\PaginationData;

class GifController extends Controller
{
    private Client $httpClient;

    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function getById(Request $request) {
        $request->validate([
            'id' => 'required|string', // El 'id' es alfanumérico
        ]);

        $params = [];
        $params = array_merge_recursive($params, $this->httpClient->getConfig('defaults'));

        $response = $this->httpClient->request('GET', $request->id, $params);
        $body     = json_decode($response->getBody());

        $gif  = new GifSingleData($body->data);
        $meta = new MetaData($body->meta);

        return response()->json([
            "data" => $gif->toArray(),
            "meta" => $meta->toArray(),
        ]);
    }

    public function getByQuery(Request $request) {
        $request->validate([
            'q'      => 'required|string',
            'limit'  => 'integer',
            'offset' => 'integer'
        ]);

        $params = [
            'query' => [
                'q'      => $request->q,
                'limit'  => $request->limit,
                'offset' => $request->offset,

            ]
        ];
        $params = array_merge_recursive($params, $this->httpClient->getConfig('defaults'));

        $response = $this->httpClient->request('GET', 'search', $params);
        $body     = json_decode($response->getBody());

        $gifs       = new GifListData($body->data);
        $pagination = new PaginationData($body->pagination);
        $meta       = new MetaData($body->meta);

        return response()->json([
            "data"       => $gifs->toArray(),
            "meta"       => $meta->toArray(),
            "pagination" => $pagination->toArray(),
        ]);
    }

    public function save(Request $request) {
        return response()->json([
            'status' => 'OK',
            'alias'  => $request->alias,
        ]);
    }
}
