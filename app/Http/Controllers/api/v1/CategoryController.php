<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::active()->orderBy('sort_order', 'asc')->get();

        return $this->showAll($categories, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return $this->showAll($category->books, 200);
    }
}
