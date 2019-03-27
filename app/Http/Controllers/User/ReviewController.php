<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Admin\Controller;
use App\Services\ReviewService;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Add review
     *
     * @param Request $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function addReview(Request $request)
    {
        dd($request->all());
        // \Log::alert($request->all());
    }
}
