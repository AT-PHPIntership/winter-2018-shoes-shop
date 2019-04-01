<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Admin\Controller;
use App\Services\ReviewService;
use App\Http\Requests\User\PostReviewRequest;

class ReviewController extends Controller
{
    /**
     * Add review
     *
     * @param PostReviewRequest $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function addReview(PostReviewRequest $request)
    {
        if (app(ReviewService::class)->addReview($request->all())) {
            return response()->json(array('success' => true, 'message' => trans('index.detail.review.mess_success')));
        }
        return response()->json(array('success' => false, 'message' => trans('index.detail.review.mess_error')));
    }
}
