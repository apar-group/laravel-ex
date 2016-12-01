@extends('layout.basic')

@section('title', 'APAR - 最新消息')

@section('header')
    @include('component.admin-header')
@endsection

@section('content')

    @include('component.errors')
    @include('component.message')

    <div>
        <a href="{{ url('/admin/news/create') }}"><button class="btn btn-raised btn-info">新增最新消息</button></a>
    </div>

    <table class="table table-striped table-hover ">
        <thead>
            <tr>
                <th>編號</th>
                <th>標題</th>
                <th>建新者</th>
                <th>建立時間</th>
                <th>最後修改時間</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($news as $row)
            <tr>
                <td>{{ $row->id }}</td>
                <td><a href="/admin/news/{{ $row->id }}/edit">{{ $row->title }}</a></td>
                <td>{{ $row->user->name }}</td>
                <td>{{ $row->created_at }}</td>
                <td>{{ $row->updated_at }}</td>
                <td>
                    <form action="/admin/news/{{ $row->id }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="delete" />
                        <input type="submit" class="btn btn-raised btn-danger" value="Delete">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endsection