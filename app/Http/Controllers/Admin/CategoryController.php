<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Http\Requests\Admin\EditCategoryRequest;

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
    public function store(CategoryRequest $request)
    {
        $input = $request->all();
        if ($this->categories->storeCategory($input)) {
            session()->flash('success', trans('common.message.create_success'));
            return redirect()->route('admin.category.index');
        }
        session()->flash('error', trans('common.message.create_error'));
        return redirect()->route('admin.category.create');
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
     * @param \Illuminate\Http\Request $request comment about this variable
     * @param int                      $id      comment about this variable
     *
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $input = $request->all();
        if ($this->categories->updateCategory($input, $category) === 'children_error') {
            session()->flash('error', trans('category.message.children_error'));
            return redirect()->route('admin.category.edit', $id);
        }
        if ($this->categories->updateCategory($input, $category)) {
            session()->flash('success', trans('common.message.edit_success'));
            return redirect()->route('admin.category.index');
        }
        session()->flash('error', trans('common.message.edit_error'));
        return redirect()->route('admin.category.edit', $id);
    }
}
