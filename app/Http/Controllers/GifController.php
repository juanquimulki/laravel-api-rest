<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

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
        return response()->json(json_decode($response->getBody()));
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
        return response()->json(json_decode($response->getBody()));
    }

    public function save(Request $request) {
        return response()->json([
            'status' => 'OK',
            'alias'  => $request->alias,
        ]);
    }
}
