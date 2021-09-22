<?php

namespace Tests\Feature\Models;

use App\Models\Book;
use App\Models\Publisher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PublisherTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function create_publisher()
    {
        $data = Publisher::factory()->make()->toArray();

        Publisher::create($data);

        $this->assertDatabaseHas('publishers', $data);
        $this->assertDatabaseCount('publishers', 1);
    }

    /**
     * @test
     */
    public function publisher_relationship_with_book()
    {
        $count = rand(1, 10);

        $publisher = Publisher::factory()
                                ->hasBooks($count)
                                ->create();

        $this->assertTrue(isset($publisher->books->first()->id));
        $this->assertTrue($publisher->books->first() instanceof Book);
        $this->assertCount($count, $publisher->books);
    }
}
