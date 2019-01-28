<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Models\Product;
use App\Services\ProductService;
use App\Services\CategoryService;
use App\Services\ColorService;
use App\Services\SizeService;
use App\Http\Requests\Admin\PostProductRequest;

class ProductController extends Controller
{
    protected $products;
    protected $categories;
    protected $sizes;
    protected $colors;

    /**
     * Create a new controller instance.
     *
     * @param ProductService  $productService  get services
     * @param CategoryService $categoryService get services
     * @param SizeService     $sizeService     get services
     * @param ColorService    $colorService    get services
     *
     * @return void
     */
    public function __construct(ProductService $productService, CategoryService $categoryService, SizeService $sizeService, ColorService $colorService)
    {
        $this->products = $productService;
        $this->categories = $categoryService;
        $this->sizes = $sizeService;
        $this->colors = $colorService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->products->getListWithPaginate();
        return view('admin.product.list', compact('products'));
    }

    /**
     * Display the specified product.
     *
     * @param int $id product
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->products->getProductbyId($id);
        return view('admin.product.detail', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categories->getParentList();
        $sizes = $this->sizes->getSizes();
        $colors = $this->colors->getColors();
        return view('admin.product.create', compact('categories', 'sizes', 'colors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request comment about this variable
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PostProductRequest $request)
    {
        $data = $request->all();
        if ($this->products->storeProduct($data)) {
            return redirect()->route('admin.product.index')->with('success', trans('common.message.create_success'));
        }
        return redirect()->route('admin.product.create')->with('error', trans('common.message.create_error'));
    }

    /**
     * Get all color and size from database.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDetail()
    {
        $color = $this->colors->getColors();
        $size = $this->sizes->getSizes();
        return response()->json(['color' => $color, 'size' => $size]);
    }
}
