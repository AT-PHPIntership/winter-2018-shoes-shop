<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Admin\Controller;
use App\Services\ProductService;
use App\Services\CategoryService;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function category()
    {
        $products = app(ProductService::class)->getProductWithPaginate();
        $parentCategories = app(CategoryService::class)->getParentList();
        return view('user.pages.category', compact(['products', 'parentCategories']));
    }

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
        $parentCategories = app(CategoryService::class)->getParentList();
        return view('user.pages.category', compact(['products', 'parentCategories']));
    }
}
