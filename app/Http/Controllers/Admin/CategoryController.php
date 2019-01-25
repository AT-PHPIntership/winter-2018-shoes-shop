<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\CategoryRequest;

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
        $categories = $this->categories->getParentList();
        return view('admin.category.create', compact('categories'));
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
        } else {
            Session::flash('error', _('common.message.create_error'));
            return redirect()->route('admin.adcategory.create');
        }
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
        $response = $this->categories->getChildren($request->get('id'));
        return response()->json($response);
    }
}
