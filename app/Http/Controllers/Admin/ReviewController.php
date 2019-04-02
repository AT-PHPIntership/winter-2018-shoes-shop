<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Services\ReviewService;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = app(ReviewService::class)->getReviewWithPaginate();
        return view('admin.review.list', compact('reviews'));
    }
}
