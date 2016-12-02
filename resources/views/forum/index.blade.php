@extends('layout.basic')

@section('title', 'APAR-討論')

@section('header')
    @include('component.client-header')
    <link href="{{ asset('assets/css/forum.css') }}" rel="stylesheet">
@endsection

@section('content')

    @include('component.message')

    @if(Auth::user())
        <div class="row forum-index-create-btn">
            <div class="col-md-4">
                <a href="{{ url('/forum/post/create') }}"><button class="btn btn-default">發表新文章</button></a>
            </div>
        </div>
    @endif

    <div class="forum-index-table">
        <div class="row hidden-xs">
            <div class="col-md-1">分類</div>
            <div class="col-md-5">主題</div>
            <div class="col-md-1">回覆</div>
            <div class="col-md-1">人氣</div>
            <div class="col-md-3">作者 / 最新回覆時間</div>
        </div>
        @foreach($posts as $post)
            @if(! $post->user)
                @continue
            @endif
                <div class="row">
                    <div class="col-md-1 vcenter">{{ trans("category.{$post->category}") }}</div>
                    <div class="col-md-5 vcenter">
                        <a href="/forum/post/{{ $post->id }}"><h3>{{ $post->title }}</h3></a>
                        <small><i>發佈： {{ $post->created_at }}</i></small>
                    </div>
                    <div class="col-md-1 vcenter"><h3>{{ $post->comment }}</h3></div>
                    <div class="col-md-1 vcenter"><h3>{{ $post->review }}</h3></div>
                    <div class="col-md-3 vcenter">
                        <h3>{{ $post->user->name }}</h3>
                        @if($post->comment > 0)
                            <small><i>最後回覆： {{  $post->last_comment_at }}</i></small>
                        @endif
                    </div>
                </div>
        @endforeach
    </div>

    <div>
        {!! $posts->render() !!}
    </div>

@endsection
