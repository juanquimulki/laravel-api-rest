<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\DataTransferObjects\ResponseSingleData;
use App\DataTransferObjects\ResponseListData;

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

        return response()->json((new ResponseSingleData($body))->toArray());
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

        return response()->json((new ResponseListData($body))->toArray());
    }
}
