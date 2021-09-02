<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Category;

class CategoryTransformer extends TransformerAbstract
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
    public function transform(Category $category)
    {
        return [
            'id'   => $category->id,
            'name' => $category->name,
            'links' => [
                [
                    'rel'  => 'self',
                    'type' => 'GET',
                    'href' => route('categories.show', $category->id)
                ]
            ]
        ];
    }
}
