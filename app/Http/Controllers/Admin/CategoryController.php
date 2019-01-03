<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

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
        return view('admin.category.list', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents = $this->categories->getParent();
        return view('admin.category.create', compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request comment about this variable
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($this->categories->storeCategory($request)) {
            session()->flash('message', trans('common.message.create_success'));
            return redirect()->route('category.index');
        } else {
            session()->flash('message', trans('common.message.create_error'));
            return redirect()->route('category.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id comment about this variable
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
     * @param int $id comment about this variable
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->categories->getCategoryById($id);
        $parents = $this->categories->getParent();
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
    public function update(Request $request, $id)
    {
        if ($this->categories->updateCategory($request, $id)) {
            session()->flash('message', trans('common.message.edit_success'));
            return redirect()->route('category.index');
        } else {
            session()->flash('message', trans('common.message.edit_error'));
            return redirect()->route('category.edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id comment about this variable
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->categories->deleteCategory($id)) {
            session()->flash('message', trans('common.message.delete_success'));
            return redirect()->route('category.index');
        } else {
            session()->flash('message', trans('common.message.delete_error'));
            return redirect()->route('category.index');
        }
    }

    /**
     * Search data of categories.
     *
     * @param \Illuminate\Http\Request $request from search form
     *
     * @return \Illuminate\Http\Response
     */
    public function searchData(Request $request)
    {
        $categories = $this->categories->searchData($request);
        return view('admin.category.list', compact('categories'));
    }
}
