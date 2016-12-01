@extends('layout.basic')

@section('title', 'APAR - Register')

@section('header')
    @include('component.admin-header')
@endsection

@section('content')

    @include('component.errors')
    @include('component.message')

    <div class="well bs-component">
        <form class="form-horizontal" id="register" method="post" action="/admin/user">
            {{ csrf_field() }}
            <fieldset>
                <legend>新增使用者</legend>
                <div class="form-group is-empty">
                    <label for="name" class="col-md-2 control-label">帳號</label>

                    <div class="col-md-10">
                        <input name="name" id="name" class="form-control" placeholder="John" value="{{ old('name') }}">
                    </div>
                </div>

                <div class="form-group is-empty">
                    <label for="inputEmail" class="col-md-2 control-label">電子郵件</label>

                    <div class="col-md-10">
                        <input name="email" type="email" class="form-control" id="inputEmail" placeholder="Email">
                    </div>
                </div>

                <div class="form-group">
                    <label for="level" class="col-md-2 control-label">權限</label>

                    <div class="col-md-10">
                        <select name="level" id="level" class="form-control">
                            <option value="0">0</option>
                            @if (Auth::user()->level == \App\User::ADMIN)
                            <option value="1">1</option>
                            @endif
                            <option value="2">2</option>
                        </select>
                    </div>
                </div>

                <div class="form-group is-empty">
                    <label for="password" class="col-md-2 control-label">密碼</label>

                    <div class="col-md-10">
                        <input name="password" type="password" class="form-control" id="password" placeholder="Password">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-10 col-md-offset-2">
                        <button type="submit" class="btn btn-primary">建立使用者</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>

@endsection
