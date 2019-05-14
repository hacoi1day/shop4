<?php

namespace App\Http\Controllers;

use App\Category;
use App\CategoryGlobal;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $categoryGlobal;
    protected $category;

    public function __construct(Category $category, CategoryGlobal $categoryGlobal)
    {
        $this->categoryGlobal = $categoryGlobal;
        $this->category = $category;
    }

    public function index()
    {
        $categoryGlobals = $this->categoryGlobal->all();
        $categories = $this->category->paginate(10);
        return view('home.index', ['categoryGlobals' => $categoryGlobals, 'categories' => $categories]);
    }

    public function search(Request $request)
    {
        $param = $request->all();
        dd($param);
    }
}
