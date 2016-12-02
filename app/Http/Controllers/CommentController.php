<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use App\Traits\CaptchaTrait;

class CommentController extends Controller
{
    use CaptchaTrait;

    private $authUser = null;

    public function __construct()
    {
        $this->middleware('auth');
        $this->authUser = Auth::user();
    }

    public function store(Request  $request)
    {
        $validator = Validator::make($request->all(), [
            'post_id' => 'required',
            'content' => 'required',
            'g-recaptcha-response'  => 'required'
        ]);

        if ($validator->fails())
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();

        if($this->captchaCheck() == false)
            return redirect()->back()
                ->withErrors(['Wrong Captcha'])
                ->withInput();

        $comment = Comment::create($request->all());
        $comment->user_id = $this->authUser->id;

        $post = Post::find($request->input('post_id'));

        if ($comment->save()) {
            $post->review++;
            $post->comment++;
            $post->last_comment_at = date('Y-m-d H:i:s');
            $post->save();
            return redirect("/forum/post/{$post->id}")->with('message', trans('comment.create_success'));
        } else {
            return response('Server Error!', '500');
        }
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        $post = $comment->post;
        $authUser = $this->authUser;

        if (! $comment) return response(trans('comment.not_exist'), 400);
        if ($authUser->id != $comment->user->id) return response('Bad Request!', 400);

        $result = $comment->delete();

        if ($result) {
            $post->comment--;
            $post->save();
        }

        return $result ? redirect("/forum/post/{$post->id}")->with('message', trans('comment.delete_success')) : response('Server Error!', '500');
    }
}
