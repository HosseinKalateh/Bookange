<?php

namespace App\Http\Resources\book;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
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
            'id'              => $this->id, 
            'category_id'     => $this->category_id, 
            'publisher_id'    => $this->publisher_id, 
            'name'            => $this->name, 
            'picture'         => asset($this->getPicturePath($this->picture)), 
            'description'     => $this->description, 
            'price'           => $this->price, 
            'ISBN'            => $this->ISBN, 
            'number_of_pages' => $this->number_of_pages, 
            'published_at'    => $this->published_at,
            'category'        => $this->category()->get(['id', 'name']),
            'publisher'       => $this->publisher()->get(['id', 'name']),
            'authors'         => $this->authors()->get(['id', 'first_name', 'last_name']),
            'translators'     => $this->translators()->get(['id', 'first_name', 'last_name']),
            'links' => [
                [
                    'rel' => 'self',
                    'type' => 'GET',
                    'href' => route('books.show', $this->id)
                ]
            ]
        ];
    }
}
