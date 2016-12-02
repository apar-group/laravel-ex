<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('last_comment_at', 'desc')->paginate(10);
        return view('admin.forum.index', ['posts' => $posts]);
    }

    public function show(Request $request, $id)
    {
        $post = Post::find($id);

        if (! $post) return response(trans('post.not_exist'), 400);

        $comments = $post->comments()->paginate(10);
        if ($request->input('page') < 2) {
            $post->review++;
            $post->save();
        }
        return view('admin.forum.show', [
            'post' => $post,
            'comments' => $comments
        ]);
    }

    public function destroy($id)
    {
        $post = Post::find($id);

        if (! $post) return response(trans('post.not_exist'), 400);

        $comments = $post->comments();

        $result = $post->delete();

        if ($result) $comments->delete();

        return $result ? redirect('/admin/forum/post')->with('message', trans('post.delete_success')) : response('Server Error!', '500');
    }
}
