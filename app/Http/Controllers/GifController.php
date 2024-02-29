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

        return response()->json([
            "data"       => (new GifSingleData($body->data))->toArray(),
            "meta"       => (new MetaData($body->meta))->toArray(),
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

        return response()->json([
            "data"       => (new GifListData($body->data))->toArray(),
            "meta"       => (new MetaData($body->meta))->toArray(),
            "pagination" => (new PaginationData($body->pagination))->toArray(),
        ]);
    }
}
