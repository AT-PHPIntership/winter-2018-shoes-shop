<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Http\Request;
use App\Services\CommentService;

class CommentController extends Controller
{
    /**
     * Get list comment
     *
     * @param Request $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function getListComment(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'productId' => 'required|exists:products,id',
            'page' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json(array('success' => false, 'message' => $validator->errors()->all()));
        }
        $paginate = app(CommentService::class)->getCommentsByProductId($request->all());
        $paginate = $paginate->toArray();
        $result = [
            'paginator' => array_except($paginate, ['data']),
            'data' => $paginate['data'],
        ];
        return response()->json(array('success' => true, 'result' => collect($result)));
    }

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
