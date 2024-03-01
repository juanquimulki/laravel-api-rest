<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use App\Classes\StatusCodes;

class ApiTest extends TestCase
{
    private static string $token;
    private static string $id;

    public static function setUpBeforeClass(): void
    {
        self::$token = "";
        self::$id    = "LzwcNOrbA3aYvXK6r7";
    }

    public function test_no_authenticated_endpoint_returns_a_successful_response(): void
    {
        $response = $this->post('/api/user/login', 
            ["email" => "prexuser@prex.com.ar", "password" => "12345654321"]
        );

        $body = json_decode($response->getContent());
        self::$token = $body->token;
        $response->assertStatus(StatusCodes::$OK);
    }

    public function test_authenticated_endpoints_returns_an_unsuccessful_response(): void
    {
        $response = $this->json('GET', '/api/getById');
        $response->assertStatus(StatusCodes::$UNAUTHORIZED);

        $response = $this->json('GET', '/api/getByQuery');
        $response->assertStatus(StatusCodes::$UNAUTHORIZED);

        $response = $this->json('POST', '/api/save');
        $response->assertStatus(StatusCodes::$UNAUTHORIZED);
    }

    public function test_getbyid_endpoint_successfully_returns_a_gif(): void
    {
        $response = $this->json('GET', '/api/getById', 
            ['id' => self::$id], 
            ['Authorization' => 'Bearer ' . self::$token]
        );

        $body = json_decode($response->getContent());

        $this->assertEquals($body->data->id, self::$id);
        $response->assertStatus(StatusCodes::$OK);

        // Intento cargar el GIF
        $response = Http::get($body->data->url);
        $this->assertEquals($response->status(), StatusCodes::$OK);
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
        
        $response->assertStatus(StatusCodes::$OK);

        // Intento cargar un GIF
        $response = Http::get($body->data[0]->url);
        $this->assertEquals($response->status(), StatusCodes::$OK);
    }

    public function test_save_endpoint_successfully_saves_and_returns_the_record(): void
    {
        $response = $this->json('POST', '/api/save', 
            ['gif_id' => self::$id, 'alias' => 'My gif alias'], 
            ['Authorization' => 'Bearer ' . self::$token]
        );

        $body = json_decode($response->getContent());

        $this->assertTrue(isset($body->id));
        $response->assertStatus(StatusCodes::$CREATED);
    }
}
