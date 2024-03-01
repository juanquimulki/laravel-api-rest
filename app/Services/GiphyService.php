<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\DataTransferObjects\GiphyData;

class GiphyService implements IGiphyService {

    private Client $httpClient;

    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function getById(string $id)
    {
        $params = [];
        $params = array_merge_recursive($params, $this->httpClient->getConfig('defaults'));

        $response = $this->httpClient->request('GET', $id, $params);
        $body     = json_decode($response->getBody());

        return $body;
    }

    public function getByQuery(GiphyData $data)
    {
        $params = [
            'query' => [
                'q'      => $data->query,
                'limit'  => $data->limit,
                'offset' => $data->offset,

            ]
        ];
        $params = array_merge_recursive($params, $this->httpClient->getConfig('defaults'));

        $response = $this->httpClient->request('GET', 'search', $params);
        $body     = json_decode($response->getBody());

        return $body;
    }
}
