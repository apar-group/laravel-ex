@extends('layout.basic')

@section('title', "APAR-討論-{$post->title}")

@section('header')
    @include('component.client-header')
    <link href="{{ asset('assets/css/forum.css') }}" rel="stylesheet">
@endsection

@section('content')

    @include('component.errors')
    @include('component.message')

    <div class="row form-show-title">
        <div class="col-md-1 col-sm-9 col-xs-1">
            <h4><div class="label label-default">{{ trans("category.{$post->category}") }}</div></h4>
        </div>
        <div class="col-md-9 col-sm-9 col-xs-9">
            <h2>{{ $post->title }}</h2>
        </div>
    </div>

    <hr style="background-color: #BDBDBD">

    @if (app('request')->input('page') < 2)
        <div class="panel panel-default" id="a9">
            <div class="panel-heading"></div>
            <div class="panel-body thread-row">
                <div class="row">
                    <div class="col-md-2 col-sm-3 hidden-xs text-center">
                        <img class="img-thumbnail avatar" src='{{ asset("assets/images/user/{$post->user->photo}") }}'>
                        <p></p>
                        <h4>{{ $post->user->name }}</h4>
                    </div>
                    <div class="col-md-8 col-sm-6 col-xs-12">
                        <small>Posted: {!! $post->created_at !!}</small>
                        <hr>
                        <div class="content_body">
                            {!! $post->content !!}
                        </div>
                    </div>
                    @if($post->user->id == Auth::id())
                    <div class="col-md-2 col-sm-3 col-xs-12">
                        <div>
                            <a href="{{ url("/forum/post/{$post->id}/edit") }}">
                                <button type="button" class="btn btn-raised btn-primary">編輯文章</button>
                            </a>
                        </div>
                        <form action="/forum/post/{{$post->id}}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="delete" />
                            <input type="submit" class="btn btn-raised btn-danger" value="刪除文章">
                        </form>
                    </div>
                    @endif
                </div>
            </div>
            <div class="panel-footer"></div>
        </div>
    @endif

    {{--comment--}}
    @foreach($comments as $comment)
        @if(! $comment->user)
            @continue
        @endif
        <div class="panel panel-default" id="a9">
            <div class="panel-heading"></div>
            <div class="panel-body thread-row">
                <div class="row thread-row">
                    <div class="col-md-2 col-sm-3 hidden-xs text-center">
                        <img class="img-thumbnail avatar" src='{{ asset("assets/images/user/{$comment->user->photo}") }}'>
                        <p></p>
                        <h4>{{ $comment->user->name }}</h4>
                    </div>
                    <div class="col-md-8 col-sm-6 col-xs-12">
                        <small>Posted: {!! $comment->created_at !!}</small>
                        <hr>
                        <div class="content_body">
                            {!! $comment->content !!}
                        </div>
                    </div>
                    @if($comment->user->id == Auth::id())
                    <div class="col-md-2 col-sm-3 col-xs-12">
                        <form action="/forum/comment/{{$comment->id}}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="delete" />
                            <input type="submit" class="btn btn-raised btn-danger" value="刪除回覆">
                        </form>
                    </div>
                    @endif
                </div>
            </div>
            <div class="panel-footer"></div>
        </div>
    @endforeach

    <div>
        {!! $comments->render() !!}
    </div>

    {{--reply area--}}
    @if (Auth::user())
    <div class="row">
        <div class="col-md-12">
            <form id="comment-create" method="post" action="/forum/comment">
                {{ csrf_field() }}

                <input type="hidden" name="post_id" value="{{ $post->id }}" />

                <textarea class="form-show-comment-text" name="content" id="comment-create-content" placeholder="請輸入回覆內容">{{ old('content') }}</textarea>

                <div class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}"></div>

                <button type="submit" class="btn btn-primary">發佈回覆</button>
            </form>
        </div>
    </div>
    @endif

    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script type="text/javascript">
        bkLib.onDomLoaded(function() {
            var editor = new nicEditor({
                fullPanel : true,
                iconsPath : '{{ asset('assets/vendor/nic/nicEditorIcons.gif') }}'
            });
            editor.panelInstance('comment-create-content');
            $('#show-post-content').attr('contenteditable', false);
        });
    </script>

@endsection
