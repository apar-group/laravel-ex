@extends('layout.basic')

@section('title', 'APAR - Register')

@section('header')
    @include('component.admin-header')
@endsection

@section('content')

    @include('component.errors')
    @include('component.message')

    <div class="well bs-component">
        <form class="form-horizontal" id="member" method="post" action="/admin/member">
            {{ csrf_field() }}
            <fieldset>
                <legend>新增研究群成員</legend>
                <div class="form-group is-empty">
                    <label for="name" class="col-md-2 control-label">姓名</label>

                    <div class="col-md-10">
                        <input name="name" id="name" class="form-control" placeholder="John" value="{{ old('name') }}">
                    </div>
                </div>

                <div class="form-group is-empty">
                    <label for="inputEmail" class="col-md-2 control-label">電子郵件</label>

                    <div class="col-md-10">
                        <input name="email" type="email" class="form-control" id="inputEmail" placeholder="Email" value="{{ old('email') }}">
                    </div>
                </div>

                <div class="form-group is-empty">
                    <label for="user_id" class="col-md-2 control-label">連結使用者</label>

                    <div class="col-md-10">
                        <select name="user_id" id="user_id"  class="form-control">
                            <option value="">無</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group is-empty">
                    <label for="year" class="col-md-2 control-label">APAR級數</label>

                    <div class="col-md-10">
                        <select name="year" id="year"  class="form-control">
                            @for($i = 89; $i < (date("Y") - 1911); $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="form-group is-empty">
                    <label for="site" class="col-md-2 control-label">個人網站</label>

                    <div class="col-md-10">
                        <input name="site" id="site" class="form-control" value="{{ old('site') }}">
                    </div>
                </div>

                <div class="form-group is-empty">
                    <label for="hobbies" class="col-md-2 control-label">興趣</label>

                    <div class="col-md-10">
                        <input name="hobbies[]" id="hobbies" class="form-control">
                        <button type="button" name="add-row">+</button>
                    </div>
                </div>

                <div class="form-group is-empty">
                    <label for="expertise" class="col-md-2 control-label">專長</label>

                    <div class="col-md-10">
                        <input name="expertise[]" id="expertise" class="form-control">
                        <button type="button" name="add-row">+</button>
                    </div>
                </div>

                <div class="form-group is-empty">
                    <label for="qualifications" class="col-md-2 control-label">證照</label>

                    <div class="col-md-10">
                        <input name="qualifications[]" id="qualifications" class="form-control">
                        <button type="button" name="add-row">+</button>
                    </div>
                </div>

                <div class="form-group is-empty">
                    <label for="education" class="col-md-2 control-label">學歷</label>

                    <div class="col-md-10">
                        <input name="education[]" id="education" class="form-control">
                        <button type="button" name="add-row">+</button>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-10 col-md-offset-2">
                        <button type="submit" class="btn btn-primary">建立新成員</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>

    <script>
        $("button[name=add-row]").click(function() {
            var prevNode = $(this).prev();
            prevNode.clone().val("").insertAfter(prevNode);
        });
    </script>

@endsection
