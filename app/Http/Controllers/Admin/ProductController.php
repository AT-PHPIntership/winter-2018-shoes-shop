<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Models\Product;
use App\Services\ProductService;
use App\Services\CategoryService;
use App\Services\ColorService;
use App\Services\SizeService;
use Excel;
use App\Http\Requests\Admin\PostProductRequest;
use App\Http\Requests\Admin\UploadRequest;

class ProductController extends Controller
{
    protected $products;
    protected $categories;
    protected $sizes;
    protected $colors;

    /**
     * Create a new controller instance.
     *
     * @param ProductService  $productService  productService
     * @param CategoryService $categoryService categoryService
     * @param SizeService     $sizeService     sizeService
     * @param ColorService    $colorService    colorService
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
     * @param \Illuminate\Http\Request $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PostProductRequest $request)
    {
        $data = $request->all();
        if ($this->products->handleStoreProduct($data)) {
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

    /**
     * Import csv file including products data.
     *
     * @return \Illuminate\Http\Response
     */
    public function importFile()
    {
        return view('admin.product.import');
    }

    /**
     * Handle process import file csv including products data.
     *
     * @param \app\Http\Request\UploadRequest $request file csv from view
     *
     * @return \Illuminate\Http\Response
     */
    public function processImport(UploadRequest $request)
    {
        try {
            $path = $request->file('csv_file')->getRealPath();
            $data = Excel::load($path)->get();
            if ($this->products->handleImportData($data)) {
                session()->flash('success', trans('common.message.upload_success'));
                return redirect()->route('admin.product.index');
            }
            return redirect()->route('admin.product.import');
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
