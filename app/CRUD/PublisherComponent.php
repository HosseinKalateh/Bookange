<?php

namespace App\CRUD;

use EasyPanel\Contracts\CRUDComponent;
use App\Models\Publisher;

class PublisherComponent implements CRUDComponent
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
        return Publisher::class;
    }

    // which kind of data should be showed in list page
    public function fields()
    {
        return ['name'];
    }

    // Searchable fields, if you dont want search feature, remove it
    public function searchable()
    {
        return ['name'];
    }

    // Write every fields in your db which you want to have a input
    // Available types : "ckeditor", "text", "file", "textarea", "password", "number", "email", "select"
    public function inputs()
    {
        return [
            'name' => 'text'
        ];
    }

    // Validation in update and create actions
    // It uses Laravel validation system
    public function validationRules()
    {
        return [
            'name' => 'required|min:2|max:191|unique:publishers,name'
        ];
    }

    // Where files will store for inputs
    public function storePaths()
    {
        return [];
    }
}
