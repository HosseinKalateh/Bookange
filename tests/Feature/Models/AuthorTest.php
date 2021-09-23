<?php

namespace Tests\Feature\Models;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthorTest extends TestCase
{
    use RefreshDatabase, HelperModelTesting;

    public function model(): Model
    {
       return new Author();
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
