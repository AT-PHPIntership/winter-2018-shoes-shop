<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Models\Product;
use App\Services\ProductService;

class ProductController extends Controller
{
    /**
     * The category Service implementation.
     *
     * @var categoryService
     */
    protected $products;

    /**
     * Create a new controller instance.
     *
     * @param ProductService $productService get services
     *
     * @return void
     */
    public function __construct(ProductService $productService)
    {
        $this->products = $productService;
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->products->getProductbyId($id);
        return view('admin.product.detail', compact('product'));
    }

}
