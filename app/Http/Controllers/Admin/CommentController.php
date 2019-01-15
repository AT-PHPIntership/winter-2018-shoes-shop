<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Services\CommentService;
use App\Models\Comment;

class CommentController extends Controller
{
    private $commentService;

    /**
    * Contructer
    *
    * @param App\Service\CommentService $commentService commentService
    *
    * @return void
    */
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = $this->commentService->getCommentWithPaginate();
        return view('admin.comment.list', compact('comments'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\Models\Comment $comment comment
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        if ($this->commentService->destroy($comment)) {
            return redirect()->route('admin.comments.index')->with('success', trans('common.message.delete_success'));
        }
        return redirect()->route('admin.comments.index')->with('error', trans('common.message.delete_error'));
    }
}
