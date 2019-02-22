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
        $category = app(CategoryService::class)->getCategoryById($id);
        $colors = app(ColorService::class)->getAll(['id','name']);
        $sizes = app(SizeService::class)->getAll(['id','size']);
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
        if ($request->input('colorId')) {
            return app(ProductService::class)->getSizesByColorId($request->input('colorId'));
        }
        return null;
    }
}
