@extends('layout.basic')

@section('title', 'APAR - 最新消息')

@section('header')
    @include('component.client-header')
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h2>{{ $news->title }}</h2>
        </div>
        <div class="col-md-12">
            發佈：{{ $news->created_at }}
        </div>
        <div class="col-md-12">
            編輯：{{ $news->updated_at }}
        </div>
    </div>
    <hr>
    <div class="row news-show-content">
        <div class="col-md-10">
            {!! $news->content !!}
        </div>
        <div class="col-md-12 news-show-back">
            <a href="{{ URL::previous() }}"><img src="{{ asset('assets/images/arrow-back.png') }}"></a>
        </div>
    </div>

@endsection
