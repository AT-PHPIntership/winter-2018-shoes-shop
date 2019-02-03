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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function category()
    // {
    //     $products = app(ProductService::class)->getProductWithPaginate();
    //     $parentCategories = app(CategoryService::class)->getParentList();
    //     $colors = app(ColorService::class)->getAll(['id','name']);
    //     return view('user.pages.category', compact(['products', 'parentCategories', 'colors']));
    // }

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
        // $parentCategories = app(CategoryService::class)->getParentList();
        $colors = app(ColorService::class)->getAll(['id','name']);
        // $sizes = app(SizeService::class)->getAll(['id','size']);
        return view('user.pages.category', compact(['products', 'colors']));
    }

    /**
     * Get list product by colorId
     *
     * @param int $id id
     *
     * @return \Illuminate\Http\Response
     */
    public function getProductsByColorIdAndCategoryId(Request $request)
    {
        $products = app(ProductService::class)->getProductsByColorIdAndCategoryId($request->input('colorId'), $request->input('categoryId'));
        // $colors = app(ColorService::class)->getAll(['id','name']);
        // return view('user.pages.category', compact(['products', 'colors']));
        return $products;
    }
}
