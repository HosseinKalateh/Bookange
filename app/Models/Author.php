<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;
use App\Transformers\AuthorTransformer;

class Author extends Model
{
    use HasFactory;

    const Per_Page = 10;

    public $transformer = AuthorTransformer::class;

    protected $hidden = ['pivot'];

    protected $fillable = ['first_name', 'last_name', 'description'];

    // Get FullName 
    public function GetFullName()
    {
    	return $this->first_name . ' ' . $this->last_name;
    }

    ## Relations ##

    // Relation With Book
    public function books()
    {
    	return $this->belongsToMany(Book::class);
    }
}
