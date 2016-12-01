@extends('layout.basic')

@section('title', 'APAR - 討論區')

@section('header')
    @include('component.admin-header')
@endsection

@section('content')

    @include('component.errors')
    @include('component.message')

    <table class="table table-striped table-hover ">
        <thead>
            <tr>
                <th>分類</th>
                <th>主題</th>
                <th>作者</th>
                <th>回覆</th>
                <th>人氣</th>
                <th>發表時間</th>
                <th>最新回覆</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            @if(! $post->user)
                @continue
            @endif
            <tr>
                <td>{{ trans("category.{$post->category}") }}</td>
                <td><a href="/admin/forum/post/{{ $post->id }}">{{ $post->title }}</a></td>
                <td>{{ $post->user->name }}</td>
                <td>{{ $post->comment }}</td>
                <td>{{ $post->review }}</td>
                <td>{{ $post->created_at }}</td>
                <td>
                    @if($post->review > 0)
                        {{  $post->last_comment_at }}
                    @endif
                </td>
            </tr>
            @endforeach
            <tr>
                {!! $posts->render() !!}
            </tr>
        </tbody>
    </table>

@endsection
