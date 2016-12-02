<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Comment;

class CommentController extends Controller
{
    public function destroy($id)
    {
        $comment = Comment::find($id);

        if (! $comment) return response(trans('comment.not_exist'), 400);

        $post = $comment->post;

        $result = $comment->delete();

        if ($result) {
            $post->comment--;
            $post->save();
        }

        return $result ? redirect("/admin/forum/post/{$post->id}")->with('message', trans('comment.delete_success')) : response('Server Error!', '500');
    }
}
