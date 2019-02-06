<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Admin\Controller;
use App\Services\ProductService;
use App\Services\CategoryService;
use App\Services\ColorService;
use App\Services\SizeService;
use Illuminate\Http\Request;

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
        $products = app(ProductService::class)->getProductByCatIdWithPaginate($id);
        $category = app(CategoryService::class)->getCategoryById($id);
        $colors = app(ColorService::class)->getAll(['id','name']);
        $sizes = app(SizeService::class)->getAll(['id','size']);
        return view('user.pages.category', compact(['products', 'colors', 'sizes', 'category']));
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
     * Get detail product
     *
     * @param Request $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function getDetailProduct(Request $request)
    {
        $response = app(ProductService::class)->getProductById($request->input('id'));
        return $response;
    }
}
