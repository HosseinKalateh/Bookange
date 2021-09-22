<?php

namespace Tests\Feature\Models;

use App\Models\Translator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TranslatorTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function create_translator()
    {
        $data = Translator::factory()->make()->toArray();

        Translator::create($data);

        $this->assertDatabaseHas('translators', $data);
        $this->assertDatabaseCount('translators', 1);
    }
}
