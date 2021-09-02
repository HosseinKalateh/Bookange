<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Author;

class AuthorTransformer extends TransformerAbstract
{
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
    public function transform(Author $author)
    {
        return [
            'id'         => $author->id,
            'first_name' => $author->first_name,
            'last_name'  => $author->last_name,
            'links'      => 
                [   
                    'rel'  => 'self',
                    'type' => 'GET',
                    'href' => route('authors.show', $author->id)
                ]
        ];
    }
}
