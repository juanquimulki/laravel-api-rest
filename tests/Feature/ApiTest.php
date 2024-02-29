<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;

class ApiTest extends TestCase
{
    private static string $token;

    public static function setUpBeforeClass(): void
    {
        self::$token = "";
    }

    public function test_no_authenticated_endpoint_returns_a_successful_response(): void
    {
        $response = $this->post('/api/user/login', 
            ["email" => "prexuser@prex.com.ar", "password" => "12345654321"]
        );

        $body = json_decode($response->getContent());
        self::$token = $body->token;
        $response->assertStatus(200);
    }

    public function test_authenticated_endpoints_returns_an_unsuccessful_response(): void
    {
        $response = $this->json('GET', '/api/getById');
        $response->assertStatus(401);

        $response = $this->json('GET', '/api/getByQuery');
        $response->assertStatus(401);

        $response = $this->json('POST', '/api/save');
        $response->assertStatus(401);
    }

    public function test_getbyid_endpoint_successfully_returns_a_gif(): void
    {
        $id = "LzwcNOrbA3aYvXK6r7";

        $response = $this->json('GET', '/api/getById', 
            ['id' => $id], 
            ['Authorization' => 'Bearer ' . self::$token]
        );

        $body = json_decode($response->getContent());

        $this->assertEquals($body->data->id, $id);
        $response->assertStatus(200);

        // Intento cargar el GIF
        $response = Http::get($body->data->url);
        $this->assertEquals($response->status(), 200);
    }

    public function test_getbyquery_endpoint_successfully_returns_gifs(): void
    {
        $q     = "birthday";
        $limit = 10;

        $response = $this->json('GET', '/api/getByQuery', 
            ['q' => $q, 'limit' => 10], 
            ['Authorization' => 'Bearer ' . self::$token]
        );

        $body = json_decode($response->getContent());

        $this->assertTrue(gettype($body->data) == 'array');
        $this->assertTrue(count($body->data) > 0 && count($body->data) <= $limit);
       
        $this->assertTrue(isset($body->meta));
        $this->assertTrue(isset($body->pagination));
        
        $response->assertStatus(200);

        // Intento cargar un GIF
        $response = Http::get($body->data[0]->url);
        $this->assertEquals($response->status(), 200);
    }
}
