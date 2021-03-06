<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\User;
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
        return Comment::orderBy('id', 'desc')->paginate(config('define.paginate.limit_rows'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment comment
     *
     * @return boolean
     */
    public function destroy(Comment $comment)
    {
        try {
            if (!$comment->children->isEmpty()) {
                foreach ($comment->children as $child) {
                    $child->delete();
                }
            }
            $comment->delete();
            return $comment;
        } catch (\Exception $e) {
            Log::error($e);
        }
        return false;
    }
    
    /**
     * Change status comment
     *
     * @param int $status status
     * @param int $id     id
     *
     * @return boolean
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
