<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\Response;
use App\Models\User;
use App\Transformers\UserTransformer;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test 
     */
    public function test_register_method_validations() 
    {

        ## General Data ##
        $headers = ['Accept' => "application/json"];

        #### name Required ###

        // Prepare
        $data = [
            'name' => '',
        ];

        // Action
        $response = $this->json('post', 'api/v1/auth/register', $data, $headers);

        // Assert
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $response->assertJsonValidationErrors([
            'name' => 'The name field is required.', 
        ]);

        #### email Required ###
        
        // Prepare
        $data = [
            'email' => '',
        ];

        // Action
        $response = $this->json('post', 'api/v1/auth/register', $data, $headers);

        // Assert
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $response->assertJsonValidationErrors([
            'email' => 'The email field is required.', 
        ]);

        #### password Required ###
        
        // Prepare
        $data = [
            'password' => '',
        ];

        // Action
        $response = $this->json('post', 'api/v1/auth/register', $data, $headers);

        // Assert
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $response->assertJsonValidationErrors([
            'password' => 'The password field is required.', 
        ]);

        #### name Min 3 ###

        // Prepare
        $data = [
            'name' => 'aa',
        ];

        // Action
        $response = $this->json('post', 'api/v1/auth/register', $data, $headers);

        // Assert
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $response->assertJsonValidationErrors([
            'name' => 'The name must be at least 3 characters.', 
        ]);

        #### email Must Be Valid ###

        // Prepare
        $data = [
            'email' => 'bookange',
        ];

        // Action
        $response = $this->json('post', 'api/v1/auth/register', $data, $headers);

        // Assert
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $response->assertJsonValidationErrors([
            'email' => 'The email must be a valid email address.', 
        ]);

        #### email Must Be Unique ###

        // Prepare
        $user = User::factory()->create();

        $data = [
            'email' => $user->email,
        ];

        // Action
        $response = $this->json('post', 'api/v1/auth/register', $data, $headers);

        // Assert
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $response->assertJsonValidationErrors([
            'email' => 'The email has already been taken.', 
        ]);

        #### password Min 6 ###

        // Prepare
        $data = [
            'password' => '12345',
        ];

        // Action
        $response = $this->json('post', 'api/v1/auth/register', $data, $headers);

        // Assert
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $response->assertJsonValidationErrors([
            'password' => 'The password must be at least 6 characters.', 
        ]);
    }


    /**
     * @test 
     */
    public function user_can_register()
    {
        // Prepare
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => $this->faker->numberBetween(100000, 1000000)
        ];
        
        $headers = ['Accept' => "application/json"];

        // Action
        $response = $this->json('post', 'api/v1/auth/register', $data, $headers);

        // Assert
        $response->assertStatus(Response::HTTP_CREATED);

        $response->assertJsonMissingValidationErrors();

        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'username', 
                'email',
                'bio',
                'age',
                'wishlist' => []
            ]
        ]);
    }

    /**
     * @test 
     */
    public function test_login_method_validations()
    {
        ## General Data ##
        $headers = ['Accept' => 'application/json'];

        #### email Required ###
        // Prepare 
        $data = [
            'email' => ''
        ];

        // Action
        $response = $this->json('post', 'api/v1/auth/login', $data, $headers);

        // Assert
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $response->assertJsonValidationErrors([
            'email' => 'The email field is required.'
        ]);

        #### password Required ###
        // Prepare 
        $data = [
            'password' => ''
        ];

        // Action
        $response = $this->json('post', 'api/v1/auth/login', $data, $headers);

        // Assert
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $response->assertJsonValidationErrors([
            'password' => 'The password field is required.'
        ]);

        #### email Must Be Valid ###
        // Prepare 
        $data = [
            'email' => 'bookange'
        ];

        // Action
        $response = $this->json('post', 'api/v1/auth/login', $data, $headers);

        // Assert
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $response->assertJsonValidationErrors([
            'email' => 'The email must be a valid email address.'
        ]);

        #### password Min 6 ###
        // Prepare 
        $data = [
            'password' => '12345'
        ];

        // Action
        $response = $this->json('post', 'api/v1/auth/login', $data, $headers);

        // Assert
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $response->assertJsonValidationErrors([
            'password' => 'The password must be at least 6 characters.'
        ]);
    }

    /**
     * @test 
     */
    public function user_can_login()
    {
        // Prepare 
        $user = User::factory()->create();

        $data = [
            'email' => $user->email,
            'password' => 'password' // Default Password When Creating A User In UserFactory
        ];

        $headers = ['Accept' => 'application/json'];

        // Action
        $response = $this->json('post', 'api/v1/auth/login', $data, $headers);

        // Assert    
        $response->assertStatus(Response::HTTP_OK);

        $response->assertJsonStructure([
            'user' => [
                'id',
                'name',
                'username',
                'email',
                'bio',
                'age',
                'wishlist' => []
            ],
            'token'
        ]);  
    }

    /**
     * @test 
     */
    public function user_log_out_without_token()
    {
        // Prepare 
        $user = User::factory()->create();

        $headers = ['Accept' => 'application/json'];

        // Action
        $response = $this->json('post', 'api/v1/auth/logout', [], $headers);

        // Assert
        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @test 
     */
    public function user_log_out_with_token()
    {
        // Prepare 
        $user = User::factory()->create();

        $token = $user->createToken("authenticate")->accessToken;

        $headers = ['Accept' => "application/json", 'Authorization' => "Bearer $token"];

        // Action
        $response = $this->json('post', 'api/v1/auth/logout', [], $headers);

        // Assert
        $response->assertStatus(Response::HTTP_OK);

        $response->assertExactJson([
            'data' => 'successfully logged out'
        ]);
    }
}
