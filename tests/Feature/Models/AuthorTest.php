<?php

namespace Tests\Feature\Models;

use App\Models\Author;
use App\Models\Book;
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

    /**
     * @test
     */
    public function author_relationship_with_book()
    {
        $count = rand(1, 10);

        $author = Author::factory()
                    ->hasBooks($count)
                    ->create();

        $this->assertTrue(isset($author->books->first()->id));
        $this->assertTrue($author->books->first() instanceof Book);
        $this->assertCount($count, $author->books);
    }
}
