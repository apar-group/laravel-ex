@extends('layout.basic')

@section('title', 'APAR - Register')

@section('header')
    @include('component.admin-header')
@endsection

@section('content')

    @include('component.errors')
    @include('component.message')

    {{--todo 想辦法排列好看點--}}
    <div class="row">
        <div class="col-md-9 col-sm-9 col-xs-9">
            <h2>
                {{ $post->title }}
                <div class="label label-default">{{ trans("category.{$post->category}") }}</div>
            </h2>
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
                <div class="col-md-2 col-sm-3 col-xs-12">
                    <form action="/admin/forum/post/{{$post->id}}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="delete" />
                        <input type="submit" class="btn btn-raised btn-danger" value="刪除文章">
                    </form>
                </div>
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
                <div class="col-md-2 col-sm-3 col-xs-12">
                    <form action="/admin/forum/comment/{{$comment->id}}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="delete" />
                        <input type="submit" class="btn btn-raised btn-danger" value="刪除回覆">
                    </form>
                </div>
            </div>
        </div>
        <div class="panel-footer"></div>
    </div>
    @endforeach

@endsection
