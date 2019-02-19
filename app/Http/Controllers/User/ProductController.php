<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Services\CommentService;

class ProductController extends Controller
{
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
        $comments = app(CommentService::class)->getCommentsByProductId($id);
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
        return app(ProductService::class)->getSizesByColorId($request->input('colorId'));
    }
}
