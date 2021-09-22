<?php

namespace Tests\Feature\Models;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\Translator;
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

    /**
     * @test
     */
    public function book_relationship_with_category()
    {
        $book = Book::factory()
                        ->forCategory()
                        ->create();

        $this->assertTrue(isset($book->category->id));
        $this->assertTrue($book->category instanceof Category);
    }

    /**
     * @test
     */
    public function book_relationship_with_publisher()
    {
        $book = Book::factory()
                        ->forPublisher()
                        ->create();

        $this->assertTrue(isset($book->publisher->id));
        $this->assertTrue($book->publisher instanceof Publisher);
    }

    /**
     * @test
     */
    public function book_relationship_with_author()
    {
        $count = rand(1, 10);

        $book = Book::factory()
                    ->hasAuthors($count)
                    ->create();

        $this->assertTrue(isset($book->authors->first()->id));
        $this->assertTrue($book->authors->first() instanceof Author);
        $this->assertCount($count, $book->authors);
    }

    /**
     * @test
     */
    public function book_relationship_with_translator()
    {
        $count = rand(1, 10);

        $book = Book::factory()
                    ->hasTranslators($count)
                    ->create();

        $this->assertTrue(isset($book->translators->first()->id));
        $this->assertTrue($book->translators->first() instanceof Translator);
        $this->assertCount($count, $book->translators);
    }
}
