<?php

namespace Tests\Feature\Models;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function create_book()
    {
        $data = Book::factory()->make()->toArray();

        Book::create($data);

        $this->assertDatabaseHas('books', $data);
        $this->assertDatabaseCount('books', 1);
    }
}
