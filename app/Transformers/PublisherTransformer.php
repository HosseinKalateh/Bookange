<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Publisher;

class PublisherTransformer extends TransformerAbstract
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
    public function transform(Publisher $publisher)
    {
        return [
            'id'    => $publisher->id,
            'name'  => $publisher->name,
            'links' => [
                [
                    'rel'  => 'self',
                    'type' => 'GET',
                    'href' => route('publishers.show', $publisher->id)
                ]
            ]
        ];
    }
}
