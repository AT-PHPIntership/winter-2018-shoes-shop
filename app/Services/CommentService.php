<?php

namespace App\Services;

use App\Models\Comment;

class CommentService
{
    /**
     * Get all data table role
     *
     * @param array $columns columns
     *
     * @return object
     */
    public function getCommentWithPaginate()
    {
        return Comment::with(['user', 'product', 'parent'])->orderBy('id', config('define.orderBy.desc'))->paginate(config('define.paginate.limit_rows'));
    }
}
