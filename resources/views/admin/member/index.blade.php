@extends('layout.basic')

@section('title', 'APAR - Register')

@section('header')
    @include('component.admin-header')
@endsection

@section('content')

    @include('component.errors')
    @include('component.message')

    <div>
        <a href="{{ url('/admin/member/create') }}"><button class="btn btn-raised btn-info">新增研究群成員</button></a>
    </div>

    <table class="table table-striped table-hover ">
        <thead>
            <tr>
                <th>APAR級數</th>
                <th>姓名</th>
                <th>E-mail</th>
                <th>建檔時間</th>
                <th>最後修改時間</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $member)
            <tr>
                <td>{{ $member->year }}</td>
                <td><a href="/admin/member/{{ $member->id }}/edit">{{ $member->name }}</a></td>
                <td>{{ $member->email }}</td>
                <td>{{ $member->created_at }}</td>
                <td>{{ $member->updated_at }}</td>
                <td>
                    <form action="/admin/member/{{ $member->id }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="delete" />
                        <input type="submit" class="btn btn-raised btn-danger" value="Delete">
                    </form>
                </td>
            </tr>
            @endforeach
            <tr>
                <td colspan="6">{!! $members->render() !!}</td>
            </tr>
        </tbody>
    </table>

@endsection