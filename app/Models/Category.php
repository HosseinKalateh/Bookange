<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Transformers\CategoryTransformer;
use App\Models\Book;

class Category extends Model
{
    use HasFactory;

    const Per_Page = 10;

    public $transformer = CategoryTransformer::class;

    protected $fillable = ['name', 'sort_order', 'is_active'];

    ## Relations ##

    // Relation With Book
    public function books()
    {
    	return $this->hasMany(Book::class);
    }

    ## Scopes ##
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
