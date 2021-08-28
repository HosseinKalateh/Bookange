<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;

class Author extends Model
{
    use HasFactory;

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
