<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\PostCategoryRequest;
use App\Http\Requests\Admin\PutCategoryRequest;

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents = $this->categories->getParentList();
        return view('admin.category.create', compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request comment about this variable
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PostCategoryRequest $request)
    {
        $input = $request->all();
        if ($this->categories->storeCategory($input)) {
            return redirect()->route('admin.category.index')->with('success', trans('common.message.create_success'));
        }
        return redirect()->route('admin.category.create')->with('error', trans('common.message.create_error'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id comment about this variable
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->categories->getCategoryById($id);
        $parents = $this->categories->getParentList();
        return view('admin.category.edit', compact('parents', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PutCategoryRequest  $request  from edit form
     * @param App\Models\Category $category biding of id from edit form
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PutCategoryRequest $request, Category $category)
    {
        $input = $request->all();
        if ($this->categories->updateCategory($input, $category)) {
            return redirect()->route('admin.category.index')->with('success', trans('common.message.edit_success'));
        }
        return redirect()->route('admin.category.edit', $category->id);
    }
}
