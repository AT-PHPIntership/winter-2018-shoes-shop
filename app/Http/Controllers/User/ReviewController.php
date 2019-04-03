<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Admin\Controller;
use App\Services\ReviewService;
use App\Http\Requests\User\PostReviewRequest;
use App\Http\Requests\User\GetReviewRequest;
use Illuminate\Http\Request;

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

    /**
     * List review
     *
     * @param GetReviewRequest $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function getListReview(GetReviewRequest $request)
    {
        $paginate = app(ReviewService::class)->getListReview($request->all());
        $paginate = $paginate->toArray();
        $result = [
            'paginator' => array_except($paginate, ['data']),
            'data' => $paginate['data'],
        ];
        return response()->json(collect($result));
    }

    /**
     * Like review
     *
     * @param Request $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function likeReview(Request $request)
    {
        $request->validate([
            'reviewId' => 'required|exists:reviews,id',
        ]);
        if (app(ReviewService::class)->likeReview($request->all())) {
            return response()->json(array('success' => true, 'message' => trans('index.detail.like.mess_success')));
        }
        return response()->json(array('success' => false, 'message' => trans('index.detail.like.mess_error')));
    }
}
