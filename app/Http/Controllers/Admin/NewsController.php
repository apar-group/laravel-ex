<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\News;
use Illuminate\Http\Request;
use Validator;
use Auth;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::orderBy('updated_at', 'desc')->paginate(10);
        return view('admin.news.index', ['news' => $news]);
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
        ]);

        if ($validator->fails())
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();

        $user = Auth::user();
        $news = News::create($request->all());
        $news->user_id = $user->id;

        if ($news->save()) {
            return redirect("admin/news")->with('message', trans('news.create_success'));
        } else {
            return response('Server Error!', '500');
        }
    }

    public function edit($id)
    {
        $news = News::find($id);

        if (! $news) return response(trans('news.not_exist'), 400);

        return view('admin.news.edit', [
            'news' => $news,
        ]);
    }

    public function update(Request $request, $id)
    {
        $news = News::find($id);

        if (! $news) return response(trans('news.not_exist'), 400);

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
        ]);

        if ($validator->fails())
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();

        $user = Auth::user();
        $news->fill($request->all());
        $news->user_id = $user->id;

        return $news->save() ? redirect("/admin/news/{$news->id}/edit")->with('message', trans('news.updated_success')) :
            response('Server Error!', '500');
    }

    public function destroy($id)
    {
        $news = News::find($id);

        if (! $news) return response(trans('post.not_exist'), 400);

        $result = $news->delete();

        return $result ? redirect('/admin/news')->with('message', trans('post.delete_success')) : response('Server Error!', '500');
    }
}
