<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function index() {
        return view('admin.index');
    }


    function getCategories() {
        $categories = Category::all();
        return view('admin.categories')->with('categories', $categories);
    }
}
