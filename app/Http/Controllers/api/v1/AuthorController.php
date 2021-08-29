<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

use App\Models\Author;

class AuthorController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::all();

        return $this->showAll($authors);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        return $this->showAll($author->books);
    }
}
