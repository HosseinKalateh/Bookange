<?php

namespace Tests\Feature\Models;

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
}
