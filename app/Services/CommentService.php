<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\User;
use App\Models\Role;
use Log;
use Auth;

class CommentService
{
    /**
     * Get all data table role
     *
     * @return Comment
     */
    public function getCommentWithPaginate()
    {
        return Comment::with(['user:id','user.profile:user_id,name', 'product:id,name', 'parent'])
            ->orderBy('id', 'desc')->paginate(config('define.paginate.limit_rows'));
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
     * Get comments by productId with paginate
     *
     * @param array $data data
     *
     * @return Comment
     */
    public function getCommentsByProductId(array $data)
    {
        return Comment::with(['user:id,role_id','user.profile:user_id,name,avatar', 'product:id,name', 'children', 'children.user:id', 'children.user.profile:user_id,name,avatar'])
            ->where('product_id', $data['productId'])
            ->where('parent_id', null)
            ->where('status', Comment::ACTIVE_STATUS)
            ->orderBy('id', 'desc')
            ->paginate(config('define.paginate.limit_rows_comment'));
    }
    
    /**
     * Add comment in detail product
     *
     * @param array $data data
     *
     * @return Comment
     */
    public function addComment(array $data)
    {
        try {
            if (!Auth::check()) {
                return false;
            }
            $user = Auth::user();
            $param = [
                'user_id' => $user->id,
                'product_id' => $data['productId'],
                'content' => strip_tags($data['commentContent']),
                'status' => $user->role_id === Role::ADMIN_ROLE ? Comment::ACTIVE_STATUS : Comment::BLOCKED_STATUS,
            ];
            if (isset($data['commentId'])) {
                $checkComment = Comment::find($data['commentId']);
                if ($checkComment->parent_id) {
                    return false;
                }
                $param['parent_id'] = $data['commentId'];
            }
            $comment = Comment::create($param);
            if ($user->role_id !== Role::ADMIN_ROLE) {
                return $comment;
            }
            $result = [];
            $result['user_id'] = $user->id;
            $result['user_name'] = $user->profile->name;
            $result['user_avatar'] = asset($user->profile->avatar ? $user->profile->avatar : config('define.path.default_avatar'));
            $result['comment_id'] = $comment->id;
            $result['comment_content'] = $comment->content;
            $result['comment_created_at'] = $comment->created_at;
            return $result;
        } catch (\Exception $e) {
            Log::error($e);
            return false;
        }
    }

    /**
     * Remove comment in detail product
     *
     * @param array $data data
     *
     * @return boolean
     */
    public function removeComment(array $data)
    {
        try {
            $comment = Comment::find($data['commentId']);
            // if (Auth::check() && (Auth::user()->id == $comment->user_id || Auth::user()->role_id == Role::ADMIN_ROLE)) {
            if (Auth::check() && Auth::user()->id == $comment->user_id) {
                return $this->destroy($comment);
            }
            return false;
        } catch (\Exception $e) {
            Log::error($e);
            return false;
        }
    }
}
