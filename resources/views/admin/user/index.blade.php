@extends('layout.basic')

@section('title', 'APAR - Profile')

@section('header')
    @include('component.admin-header')
@endsection

@section('content')

    @include('component.errors')
    @include('component.message')

    <div>
        <a href="{{ url('/admin/user/create') }}"><button class="btn btn-raised btn-info">新增使用者</button></a>
    </div>

    <table class="table table-striped table-hover ">
        <thead>
            <tr>
                <th>id</th>
                <th>e-mail</th>
                <th>name</th>
                <th>level</th>
                @if ($user->level != \App\User::USER)
                <th>Operate</th>
                <th></th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($users as $u)
            <tr>
                @if ($user->level != \App\User::USER)
                <form id="update-{{ $u->id }}" action="/admin/user/{{ $u->id }}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="put" />
                    <td>{{ $u->id }}</td>
                    <td><input name="email" class="form-control" value="{{ $u->email }}"></td>
                    <td><input name="name" class="form-control" value="{{ $u->name }}"></td>
                    <td>
                        <select name="level" id="level" class="form-control">
                            <option value="0" @if($u->level == \App\User::USER) selected @endif>0</option>
                            @if ($user->level == 1)
                            <option value="1" @if($u->level == \App\User::ADMIN) selected @endif>1</option>
                            @endif
                            <option value="2" @if($u->level == \App\User::OPERATOR) selected @endif>2</option>
                        </select>
                    </td>
                </form>
                <td>
                    <button form="update-{{ $u->id }}" class="btn btn-raised btn-success">Edit</button>
                </td>
                <td>
                    <form action="/admin/user/{{ $u->id }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="delete" />
                        <input class="btn btn-raised btn-danger" type="submit" value="Delete">
                    </form>
                </td>
                @else
                <td>{{ $u->id }}</td>
                <td>{{ $u->email }}</td>
                <td>{{ $u->name }}</td>
                <td>{{ $u->level }}</td>
                @endif
            </tr>
            @endforeach
            <tr>
                <td colspan="6">{!! $users->render() !!}</td>
            </tr>
        </tbody>
    </table>

@endsection