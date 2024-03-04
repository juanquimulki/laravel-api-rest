<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

use App\Services\_IGiphyService as IGiphyService; 

use App\DTO\Requests\GiphyListData as GiphyListRequest;
use App\DTO\Responses\GiphyListData as GiphyListResponse;

use App\DTO\Responses\GiphySingleData;
use App\DTO\Responses\GifSingleData;
use App\DTO\Responses\GifListData;
use App\DTO\Responses\MetaData;
use App\DTO\Responses\PaginationData;

class GiphyService implements IGiphyService {

    private Client $httpClient;

    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function getById(string $id): GiphySingleData
    {
        $params = [];
        $params = array_merge_recursive($params, $this->httpClient->getConfig('defaults'));

        try {
            $response = $this->httpClient->request('GET', $id, $params);
        } catch (ClientException $e) {
            throw new \Exception('HTTP Client error');
        }
        
        $body = json_decode($response->getBody());

        $gif  = new GifSingleData($body->data);
        $meta = new MetaData($body->meta);

        $giphy = new GiphySingleData($gif, $meta);

        return $giphy;
    }

    public function getByQuery(GiphyListRequest $data): GiphyListResponse
    {
        $params = [
            'query' => [
                'q'      => $data->query,
                'limit'  => $data->limit,
                'offset' => $data->offset,

            ]
        ];
        $params = array_merge_recursive($params, $this->httpClient->getConfig('defaults'));

        try {
            $response = $this->httpClient->request('GET', 'search', $params);
        } catch (ClientException $e) {
            throw new \Exception('HTTP Client error');
        }

        $body     = json_decode($response->getBody());

        $gif        = new GifListData($body->data);
        $meta       = new MetaData($body->meta);
        $pagination = new PaginationData($body->pagination);

        $giphy = new GiphyListResponse($gif, $meta, $pagination);

        return $giphy;
    }
}
