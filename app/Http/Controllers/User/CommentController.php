<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use App\Services\CommentService;

class CommentController extends Controller
{
    /**
     * Add new comment
     *
     * @param Request $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function addComment(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'commentId' => 'exists:comments,id',
            'commentContent' => 'required',
            'productId' => 'required|exists:products,id',
            'userId' => 'required|exists:users,id',
        ]);
        if ($validator->fails()) {
            return response()->json(array('success' => false, 'message' => $validator->errors()->all()));
        }
        $response = app(CommentService::class)->addComment($request->all());
        if ($response) {
            return response()->json(array('success' => true, 'data' => $response));
        }
        return response()->json(array('success' => false, 'message' => trans('index.detail.comment.mess_error')));
    }
}
