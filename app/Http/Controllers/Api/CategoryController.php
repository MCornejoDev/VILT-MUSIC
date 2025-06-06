<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Category::select('id', 'name')->get();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
}
