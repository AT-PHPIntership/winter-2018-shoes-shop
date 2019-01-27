<?php

namespace App\Services;

use App\Models\Comment;

class CommentService
{
    /**
     * Get all data table role
     *
     * @return Comment
     */
    public function getCommentWithPaginate()
    {
        return Comment::with(['user:id', 'user.profile:user_id,name', 'product:id,name', 'parent'])->orderBy('id', 'desc')->paginate(config('define.paginate.limit_rows'));
    }
}
