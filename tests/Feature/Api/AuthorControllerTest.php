<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Author;
use Illuminate\Http\Response;

class AuthorControllerTest extends TestCase
{
    // use RefreshDatabase;

    /**
     * @test
     */
    public function index_method_when_user_not_logged_in()
    {
        // Prepare
       $headers = ['Accept' => "application/json"];

        // Action
        $response = $this->json('get', "api/v1/authors", [], $headers);

        // Assert
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @test
     */
    public function index_method_when_user_logged_in()
    {
        // Prepare
        $user = User::factory()->normal()->create();

        $token = $user->createToken("authenticate")->accessToken;

        $headers = ['Accept' => "application/json", 'Authorization' => "Bearer $token"];

        // Action
        $response = $this->json('get', 'api/v1/authors', [], $headers);

        // Assert
        $response->assertStatus(Response::HTTP_OK);

        $response->assertJsonMissingValidationErrors();

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'first_name',
                    'last_name',
                    'links' => []
                ]
            ],
            'meta' => [
                'pagination' => []
            ]
        ]);
    }

    /**
     * @test
     */
    public function show_method_when_user_not_logged_in() 
    {
        // Prepare
        $headers = ['Accept' => "application/json"];
        $author = Author::factory()
                        ->create();

        // Action
        $response = $this->json('get', 'api/v1/authors/'.$author->id, [], $headers);

        // Assert
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @test
     */
    public function show_method_when_user_logged_in() 
    {
        // Prepare
        $user = User::factory()->normal()->create();

        $token = $user->createToken("authenticate")->accessToken;

        $headers = ['Accept' => "application/json", 'Authorization' => "Bearer $token"];

        $author = Author::factory()
                        ->hasBooks(rand(1, 10))
                        ->create();

        // Action
        $response = $this->json('get', 'api/v1/authors/'.$author->id, [], $headers);
        
        // Assert
        $response->assertStatus(Response::HTTP_OK);

        $response->assertJsonMissingValidationErrors();

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'category_id',
                    'publisher_id',
                    'name',
                    'picture',
                    'description',
                    'price',
                    'ISBN',
                    'number_of_pages',
                    'published_at',
                    'category' => [],
                    'publisher' => [],
                    'authors' => [],
                    'translators' => [],
                    'in_wishlist',
                    'links' => []
                ]
            ],
            'meta' => [
                'pagination' => []
            ]
        ]);
    }
}
