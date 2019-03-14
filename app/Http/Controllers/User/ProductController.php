<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Admin\Controller;
use App\Services\ProductService;
use App\Services\CategoryService;
use App\Services\ColorService;
use App\Services\SizeService;
use Illuminate\Http\Request;
use App\Services\CommentService;

class ProductController extends Controller
{
    /**
     * Get list product by categoryId
     *
     * @param int $id id
     *
     * @return \Illuminate\Http\Response
     */
    public function listProductByCatId(int $id)
    {
        $category = app(CategoryService::class)->getCategoryById($id);
        $colors = app(ColorService::class)->getColors(['id','name']);
        $sizes = app(SizeService::class)->getSizes(['id','size']);
        return view('user.pages.category', compact(['colors', 'sizes', 'category']));
    }

    /**
     * Get products after filter
     *
     * @param Request $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function filterProduct(Request $request)
    {
        $products = app(ProductService::class)->filterProduct($request->all());
        return $products;
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
        $product = app(ProductService::class)->getDetailProduct($id);
        return view('user.pages.detail', compact(['product', 'comments']));
    }

    /**
     * Get detail product
     *
     * @param Request $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function getDetailProduct(Request $request)
    {
        $response = app(ProductService::class)->getDetailProduct($request->input('id'));
        return $response;
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
        return app(ProductService::class)->getSizesByColorId($request->input('colorId'), $request->input('productId'));
    }
}
