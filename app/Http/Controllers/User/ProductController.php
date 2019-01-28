<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;

class ProductController extends Controller
{
    /**
     * Display a specific product.
     *
     * @return \Illuminate\Http\Response
     */
    public function detail()
    {
        return view('user.pages.detail');
    }
}
