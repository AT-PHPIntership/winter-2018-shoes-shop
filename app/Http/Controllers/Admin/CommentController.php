<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Services\CommentService;
use App\Http\Requests\Admin\PatchCommentRequest;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = app(CommentService::class)->getCommentWithPaginate();
        return view('admin.comment.list', compact('comments'));
    }

    /**
     * Change status comment
     *
     * @param PatchCommentRequest $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(PatchCommentRequest $request)
    {
        return app(CommentService::class)->changeStatus((int) $request->input('status'), (int) $request->input('id'));
    }
}
