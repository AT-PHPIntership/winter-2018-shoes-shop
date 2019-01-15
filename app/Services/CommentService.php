<?php

namespace App\Services;

use App\Models\Comment;
use Illuminate\Support\Facades\Log;

class CommentService
{
    /**
     * Get Comment with Paginate
     *
     * @return object
     */
    public function getCommentWithPaginate()
    {
        return Comment::with(['user', 'product', 'parent'])->orderBy('id', config('define.orderBy.desc'))->paginate(config('define.paginate.limit_rows'));
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
        try {
            if (!$comment->children->isEmpty()) {
                foreach ($comment->children as $child) {
                    $child->delete();
                }
            }
            $comment->delete();
            return $comment;
        } catch (Exception $e) {
            Log::error($e);
        }
        return false;
    }
}
