<?php

namespace App\Http\Resources\book;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\category\CategoryResource;
use App\Http\Resources\publisher\PublisherResource;
use App\Http\Resources\author\AuthorCollection;
use App\Http\Resources\translator\TranslatorCollection;

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
            'category'        => new CategoryResource($this->category),
            'publisher'       => new PublisherResource($this->publisher),
            'authors'         => new AuthorCollection($this->authors),
            'translators'     => new TranslatorCollection($this->translators),
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
