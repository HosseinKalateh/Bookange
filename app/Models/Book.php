<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\Author;
use App\Models\Translator;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
    	'category_id',
    	'publisher_id',
    	'name',
    	'picture',
    	'description',
    	'price',
    	'ISBN',
    	'number_of_pages',
    	'published_at'
    ];

    // Get Picture Path
    public function getPicturePath($path)
    {
        return $truePath = str_replace('public', 'storage', $path);
    }

    ## Relations ##

    // Relatoin With Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relation With Publisher
    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    // Relation With Author
    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }

    // Relation With Translator
    public function translators()
    {
        return $this->belongsToMany(Translator::class);
    }
}
