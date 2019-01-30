<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Admin\Controller;
use App\Services\ProductService;
use App\Services\CategoryService;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parentCategories = app(CategoryService::class)->getParentList();
        $productsForMen = app(ProductService::class)->getProductByCategory('Giày nam' ,['id', 'name', 'original_price']);
        $productsForWomen = app(ProductService::class)->getProductByCategory('Giày nữ' ,['id', 'name', 'original_price']);
        $childsCatForMen = app(CategoryService::class)->getChildCatByParentCat('Giày nam', ['id', 'name']);
        $childsCatForWomen = app(CategoryService::class)->getChildCatByParentCat('Giày nữ', ['id', 'name']);
        $newProducts = app(ProductService::class)->getNewProducts(['id', 'name', 'original_price']);
        $topSellProducts = app(ProductService::class)->getTopSellProducts(['id', 'name', 'original_price']);
        return view('user.pages.index', compact(['productsForMen', 'productsForWomen', 'childsCatForMen', 'childsCatForWomen', 'newProducts', 'topSellProducts']));
    }
}
