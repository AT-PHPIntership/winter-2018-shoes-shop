<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
     * @param CategoryService $categories comment about this variable
     *
     * @return void
     */
    public function __construct(CategoryService $categories)
    {
        $this->categories = $categories;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categories->getList();
        return view('admin/category/list', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/category/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request comment about this variable
     *
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Category $category comment about this variable
     *
     * @return \Illuminate\Http\Response
     */
    // public function show(Category $category)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Category $category comment about this variable
     *
     * @return \Illuminate\Http\Response
     */
    // public function edit(Category $category)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request  comment about this variable
     * @param \App\Models\Category     $category comment about this variable
     *
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Category $category)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Category $category comment about this variable
     *
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Category $category)
    // {
    //     //
    // }
}
