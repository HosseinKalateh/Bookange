<?php

namespace App\Http\Resources\publisher;

use Illuminate\Http\Resources\Json\JsonResource;

class PublisherResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'    => $this->id,
            'name'  => $this->name,
            'links' => [
                'rel'  => 'self',
                'type' => 'GET',
                'href' => route('publishers.show', $this->id)
            ]
        ];
    }
}
