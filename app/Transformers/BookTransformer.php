<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Transformers\AuthorTransformer;
use App\Transformers\CategoryTransformer;
use App\Transformers\PublisherTransformer;
use App\Transformers\TranslatorTransformer;
use App\Models\Book;

class BookTransformer extends TransformerAbstract
{
    public $authorTransformer = AuthorTransformer::class;
    public $categoryTransformer = CategoryTransformer::class;
    public $publisherTransformer = PublisherTransformer::class;
    public $translatorTransformer = TranslatorTransformer::class;

    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Book $book)
    {
        return [
            'id'              => $book->id, 
            'category_id'     => $book->category_id, 
            'publisher_id'    => $book->publisher_id, 
            'name'            => $book->name, 
            'picture'         => asset($book->getPicturePath($book->picture)), 
            'description'     => $book->description, 
            'price'           => $book->price, 
            'ISBN'            => $book->ISBN, 
            'number_of_pages' => $book->number_of_pages, 
            'published_at'    => $book->published_at,
            'category'        => fractal($book->category, new $this->categoryTransformer)->toArray(),
            'publisher'       => fractal($book->publisher, new $this->publisherTransformer)->toArray(),
            'authors'         => fractal($book->authors, new $this->authorTransformer)->toArray(),
            'translators'     => fractal($book->translators, new $this->translatorTransformer)->toArray(),
            'links' => [
                [
                    'rel' => 'self',
                    'type' => 'GET',
                    'href' => route('books.show', $book->id)
                ]
            ]
        ];
    }
}
