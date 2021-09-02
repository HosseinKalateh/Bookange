<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;
use App\Transformers\PublisherTransformer;

class Publisher extends Model
{
    use HasFactory;

    const Per_Page = 10;

    public $transformer = PublisherTransformer::class;

    protected $fillable = ['name'];

    ## Relations ##

    // Relation With Book
    public function books()
    {
    	return $this->hasMany(Book::class);
    }
}
