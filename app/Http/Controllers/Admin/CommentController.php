<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Services\CommentService;
use Illuminate\Http\Request;

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
     * @param \Illuminate\Http\Request $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request)
    {
        return app(CommentService::class)->changeStatus((int) $request->input('status'), (int) $request->input('id'));
    }
}
