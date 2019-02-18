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

    /**
     * Get comments by productId
     *
     * @param int $productId productId
     *
     * @return Comment
     */
    public function getCommentsByProductId(int $productId)
    {
        return Comment::with(['children', 'user:id', 'user.profile:user_id,name,avatar'])->where('product_id', $productId)->where('parent_id', null)->orderBy('updated_at', 'desc')->get(); 
    }
}
