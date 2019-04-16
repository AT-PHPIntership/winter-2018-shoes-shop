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
            return redirect()->route('admin.categories.index')->with('success', trans('common.message.create_success'));
        }
        return redirect()->route('admin.categories.create')->with('error', _('common.message.create_error'));
    }

    /**
     * Get children category from ajax request
     *
     * @param object $request request
     *
     * @return json()
     */
    public function getChildren(Request $request)
    {
        if ($request->ajax()) {
            $response = $this->categories->getChildren((int) $request->input('id'), ['id', 'name']);
            return $response;
        }
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
            return redirect()->route('admin.categories.index')->with('success', trans('common.message.edit_success'));
        }
        return redirect()->route('admin.categories.edit', $category->id);
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
            session()->flash('success', trans('common.message.block_success'));
        } else {
            session()->flash('error', trans('common.message.block_error'));
        }
        return redirect()->route('admin.categories.index');
    }

    /**
     * Display a listing of trash.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        $categories = $this->categories->getTrashWithPaginate();
        return view('admin.category.trash', compact('categories'));
    }

    /**
     * Display a listing of trash.
     *
     * @param int $id id
     *
     * @return \Illuminate\Http\Response
     */
    public function restore(int $id)
    {
        if ($this->categories->restore($id)) {
            return redirect()->route('admin.categories.index')->with('success', trans('common.message.restore_success'));
        }
        return redirect()->route('admin.categories.trash')->with('error', trans('common.message.restore_error'));
    }

    /**
     * Force delete user
     *
     * @param int $id id
     *
     * @return boolean
     */
    public function forceDelete(int $id)
    {
        if ($this->categories->forceDelete($id)) {
            return redirect()->route('admin.categories.index')->with('success', trans('common.message.delete_success'));
        }
        return redirect()->route('admin.categories.trash')->with('error', trans('common.message.delete_error'));
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
