<?php

namespace Tests\Feature\Models;

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
}
