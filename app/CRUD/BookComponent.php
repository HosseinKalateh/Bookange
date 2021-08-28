<?php

namespace App\CRUD;

use EasyPanel\Contracts\CRUDComponent;
use App\Models\Book;

class BookComponent implements CRUDComponent
{
    // Manage actions in crud
    public $create = true;
    public $delete = true;
    public $update = true;

    // If you will set it true it will automatically
    // add `user_id` to create and update action
    public $with_user_id = false;

    public function getModel()
    {
        return Book::class;
    }

    // which kind of data should be showed in list page
    public function fields()
    {
        return ['name', 'picture', 'category.name', 'publisher.name' , 'price'];
    }

    // Searchable fields, if you dont want search feature, remove it
    public function searchable()
    {
        return ['name', 'ISBN'];
    }

    // Write every fields in your db which you want to have a input
    // Available types : "ckeditor", "text", "file", "textarea", "password", "number", "email", "select"
    public function inputs()
    {
        return [
            'name' => 'text',
            'category_id' => [
                'select' => \App\Models\Category::active()->pluck('name', 'id')->toArray()
            ],
            'publisher_id' => [
                'select' => \App\Models\Publisher::query()->pluck('name', 'id')->toArray()
            ],
            'price' => 'text',
            'ISBN' => 'text',
            'number_of_pages' => 'text',
            'published_at' => 'text',
            'description' => 'ckeditor',
            'picture' => 'file'
        ];
    }

    // Validation in update and create actions
    // It uses Laravel validation system
    public function validationRules()
    {
        return [
            'category_id' => 'required',
            'publisher_id' => 'required',
            'price' => 'required|numeric',
            'ISBN' => 'required',
            'number_of_pages' => 'required',
            'published_at' => 'required',
            'description' => 'required',
        ];
    }

    // Where files will store for inputs
    public function storePaths()
    {
        return [
            'picture' => 'public/images/books'
        ];
    }
}
