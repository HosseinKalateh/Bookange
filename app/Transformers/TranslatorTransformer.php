<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Translator;

class TranslatorTransformer extends TransformerAbstract
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
    public function transform(Translator $translator)
    {
        return [
            'id'         => $translator->id,
            'first_name' => $translator->first_name,
            'last_name'  => $translator->last_name,
            'links'      => 
            [
                [
                    'rel'  => 'self',
                    'type' => 'GET',
                    'href' => route('translators.show', $translator->id)
                ]
            ]
        ];
    }
}
