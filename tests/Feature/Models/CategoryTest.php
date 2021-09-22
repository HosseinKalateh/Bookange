<?php

namespace Tests\Feature\Models;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function create_category()
    {
        $data = Category::factory()->make()->toArray();

        Category::create($data);

        $this->assertDatabaseHas('categories', $data);
        $this->assertDatabaseCount('categories', 1);
    }

    /**
     * @test
     */
    public function category_relationship_with_book()
    {
        $count = rand(1, 10);

        $category = Category::factory()
                            ->hasBooks($count)
                            ->create();

        $this->assertTrue(isset($category->books->first()->id));
        $this->assertTrue($category->books->first() instanceof Book);
        $this->assertCount($count, $category->books);
    }
}
