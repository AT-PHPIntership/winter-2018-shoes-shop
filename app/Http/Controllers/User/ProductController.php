<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Services\ProductService;
use App\Services\ColorService;
use App\Services\SizeService;

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
     * @param ColorService   $colorService   get services
     * @param SizeService    $sizeService    get services
     *
     * @return void
     */
    public function __construct(ProductService $productService,ColorService $colorService, SizeService $sizeService )
    {
        $this->products = $productService;
        $this->colors = $colorService;
        $this->sizes = $sizeService;
    }

    /**
     * Display a specific product.
     *
     * @param int $id product
     * 
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        $product = $this->products->getProductById($id);
        return view('user.pages.detail', compact('product'));
    }

    /**
     * Get sizes by colorId
     *
     * @param Request $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function getSizesByColorId(Request $request)
    {
        if ($request->input('colorId')) {
            return $this->products->getSizesByColorId($request->input('colorId'));
        }
        return $request->input('colorId');
    }
}
