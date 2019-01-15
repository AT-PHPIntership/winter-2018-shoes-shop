<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use App\Services\CommentService;

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
}
