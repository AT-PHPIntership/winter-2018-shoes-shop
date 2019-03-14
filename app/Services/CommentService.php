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

    /**
     * Get comments by productId
     *
     * @param int $productId productId
     *
     * @return Comment
     */
    public function getCommentsByProductId(int $productId)
    {
        return Comment::join('users', 'comments.user_id', '=', 'users.id')->with(['children' => function ($query) use ($productId) {
            $query->where('product_id', $productId);
        }, 'user.profile:user_id,name,avatar'])->whereNull('deleted_at')->where('product_id', $productId)->where('parent_id', null)->where('status', Comment::ACTIVE_STATUS)->get();
    }

    /**
     * Add comment
     *
     * @param array $data data
     *
     * @return Comment
     */
    public function addComment(array $data)
    {
        try {
            $param = [
                'user_id' => $data['userId'],
                'product_id' => $data['productId'],
                'content' => $data['commentContent'],
            ];
            if (isset($data['commentId'])) {
                $param['parent_id'] = $data['commentId'];
            }
            $comment = Comment::create($param);
            $user = User::with('profile:user_id,name,avatar')->findOrFail($data['userId']);
            $result = [];
            $result['user_name'] = $user->profile->name;
            $result['user_avatar'] = asset($user->profile->avatar ? $user->profile->avatar : config('define.path.default_avatar'));
            $result['comment_id'] = $comment->id;
            $result['comment_content'] = $comment->content;
            $result['comment_created_at'] = $comment->created_at->format('d/m/Y - H:i:s');
            return $result;
        } catch (\Exception $e) {
            Log::error($e);
        }
        return false;
    }
}
