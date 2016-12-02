<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use App\Post;
use Illuminate\Http\Request;
use App\Traits\CaptchaTrait;

class PostController extends Controller
{
    use CaptchaTrait;

    private $authUser = null;
    protected $categories;

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
        $this->authUser = Auth::user();
        $this->categories = range(0, 4);
    }

    public function create()
    {
        return view('forum.create', ['categories' => $this->categories]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'title' => 'required',
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

        $post = Post::create($request->all());
        $post->user_id = $this->authUser->id;

        if ($post->save()) {
            return redirect("/forum")->with('message', trans('post.create_success'));
        } else {
            return response('Server Error!', '500');
        }
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
        return view('forum.show', [
            'post' => $post,
            'comments' => $comments
        ]);
    }

    public function edit($id)
    {
        $post = Post::find($id);

        if (! $post) return response(trans('post.not_exist'), 400);

        return view('forum.edit', [
            'categories' => $this->categories,
            'post' => $post,
        ]);
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        if (! $post) return response(trans('post.not_exist'), 400);

        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'title' => 'required',
            'content' => 'required',
        ]);

        if ($validator->fails())
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();

        $authUser = $this->authUser;

        if ($authUser->id != $post->user->id) return response('Bad Request!', 400);

        $post->fill($request->all());

        return $post->save() ? redirect("/forum/post/{$post->id}")->with('message', trans('post.updated_success')) :
            response('Server Error!', '500');
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $authUser = $this->authUser;
        $comments = $post->comments();

        if (! $post) return response(trans('post.not_exist'), 400);
        if ($authUser->id != $post->user->id) return response('Bad Request!', 400);

        $result = $post->delete();

        if ($result) $comments->delete();

        return $result ? redirect('/forum')->with('message', trans('post.delete_success')) : response('Server Error!', '500');
    }
}
