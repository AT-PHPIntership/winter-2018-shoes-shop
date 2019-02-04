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
        $product = $this->products->getDetailById($id);
        $colors = $this->colors->getColorsByProduct($id);
        $sizes = $this->sizes->getSizesByProduct($id);
        return view('user.pages.detail', compact('product', 'colors', 'sizes'));
    }
}
