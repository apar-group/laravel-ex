<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::orderBy('updated_at', 'desc')->paginate(5);
        return view('news.index', ['news' => $news]);
    }

    public function show($id)
    {
        $news = News::find($id);
        return view('news.show', ['news' => $news]);
    }
}
