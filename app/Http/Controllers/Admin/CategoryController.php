<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;

class CategoryController extends Controller
{

    /**
     * The category Service implementation.
     *
     * @var categoryService
     */
    protected $categories;

    /**
     * Create a new controller instance.
     *
     * @param CategoryService $categoryService comment about this variable
     *
     * @return void
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categories = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categories->getList();
        return view('admin.category.list', compact('categories'));
    }
}
