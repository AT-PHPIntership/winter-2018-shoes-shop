<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Services\CommentService;
use App\Models\Comment;
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
     * Remove the specified resource from storage.
     *
     * @param Comment $comment comment
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        if (app(CommentService::class)->destroy($comment)) {
            return redirect()->route('admin.comments.index')->with('success', trans('common.message.delete_success'));
        }
        return redirect()->route('admin.comments.index')->with('error', trans('common.message.delete_error'));
    }

    /**
     * Change status comment
     *
     * @param Request $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request)
    {
        return app(CommentService::class)->changeStatus((int) $request->input('status'), (int) $request->input('id'));
    }
}
