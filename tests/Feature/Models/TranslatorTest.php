<?php

namespace Tests\Feature\Models;

use App\Models\Book;
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

    /**
     * @test
     */
    public function translator_relationship_with_book()
    {
        $count = rand(1, 10);

        $translator = Translator::factory()
                                ->hasBooks($count)
                                ->create();

        $this->assertTrue(isset($translator->books->first()->id));
        $this->assertTrue($translator->books->first() instanceof Book);
        $this->assertCount($count, $translator->books);
    }
}
