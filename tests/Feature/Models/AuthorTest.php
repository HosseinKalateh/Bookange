<?php

namespace Tests\Feature\Models;

use App\Models\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthorTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function create_author()
    {
        $data = Author::factory()->make()->toArray();

        Author::create($data);

        $this->assertDatabaseHas('authors', $data);
        $this->assertDatabaseCount('authors', 1);
    }
}
