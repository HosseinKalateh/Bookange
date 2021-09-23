<?php

namespace Tests\Feature\Models;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase, HelperModelTesting;

    public function model(): Model
    {
        return new Category();
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
