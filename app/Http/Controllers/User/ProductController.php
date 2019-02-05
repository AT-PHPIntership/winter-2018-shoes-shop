<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use App\Services\ProductService;

class ProductController extends Controller
{
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
