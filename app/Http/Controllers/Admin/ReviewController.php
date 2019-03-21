<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
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

    /**
     * Change status review
     *
     * @param Request $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request)
    {
        return app(ReviewService::class)->changeStatus((int) $request->input('status'), (int) $request->input('id'));
    }
}
