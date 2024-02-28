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
        return response()->json([
            'status' => 'OK',
            'id'     => $request->id,
        ]);
    }

    public function getByQuery(Request $request) {
        return response()->json([
            'status' => 'OK',
            'query'  => $request->search,
        ]);
    }

    public function save(Request $request) {
        return response()->json([
            'status' => 'OK',
            'alias'  => $request->alias,
        ]);
    }

    public function test() {
        $params = [
            'query' => [
               'api_key'  => "vPiFbtTGOAhO4qcdxepDpZVC0D2nEp23",
            ]
        ];

        $response = $this->httpClient->request('GET', "g5R9dok94mrIvplmZd", $params);
        $data = json_decode($response->getBody());
        dd($data);
    }
}
