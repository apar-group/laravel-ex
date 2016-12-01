@extends('layout.basic')

@section('title', 'APAR - 最新消息')

@section('header')
    @include('component.client-header')
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12 news-index-title">
            <h1>最新消息</h1>
        </div>
    </div>

    <div class="news-index-table">
        @foreach($news as $row)
            <div class="row">
                <div class="col-md-10">
                    <h2><a href="/news/{{ $row->id }}">{{ $row->title }}</a></h2>
                    <small>發佈： {{ $row->created_at }}</small>
                    <br>
                    <small><i>最後編輯： {{ $row->updated_at }}</i></small>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row">
        <div class="col-md-12">
            {!! $news->render() !!}
        </div>
    </div>

@endsection