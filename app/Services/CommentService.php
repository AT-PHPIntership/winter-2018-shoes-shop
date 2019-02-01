<?php

namespace App\Services;

use App\Models\Comment;
use Log;

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

    /**
     * Change status comment
     *
     * @param int $status status
     * @param int $id     id
     *
     * @return Comment
     */
    public function changeStatus(int $status, int $id)
    {
        try {
            return Comment::where('id', $id)->update(['status' => $status]);
        } catch (\Exception $e) {
            Log::error($e);
            return false;
        }
    }
}
