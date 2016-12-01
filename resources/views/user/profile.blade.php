@extends('layout.basic')

@section('title', 'APAR - Profile')

@section('header')
    @include('component.client-header')
@endsection

@section('content')

    @include('component.errors')
    @include('component.message')

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="profile">
        <form class="form-horizontal" method="post" action="/user/{{ $user->id }}/upload" enctype="multipart/form-data">
            {{ csrf_field() }}

            <fieldset>
                <legend class="col-md-12">頭像</legend>

                <div class="form-group">
                    <div class="col-md-3">
                        <img class="img-thumbnail" src='{{ asset("assets/images/user/$user->photo") }}'>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-3">
                <span class="btn btn-default btn-file">
                    選擇檔案 <input name="image" type="file">
                </span>
                        <button type="submit" class="btn btn-primary">更新</button>
                    </div>
                </div>
            </fieldset>

        </form>

        <form action="/user/{{ $user->id }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="put" />

            <fieldset>
                <legend>個人資料</legend>

                <div class="form-group">
                    <label for="user-profile-name">Name</label>
                    <input id="user-profile-name" name="name" value="{{ $user->name }}">
                </div>

                <div class="form-group">
                    <label for="user-profile-email">Email</label>
                    <input id="user-profile-email" name="email" value="{{ $user->email }}">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">更新</button>
                </div>
            </fieldset>
        </form>

        <form action="/user/{{ $user->id }}/password" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="put" />

            <fieldset>
                <legend>變更密碼</legend>

                <div class="form-group">
                    <label for="user-old-password">舊密碼</label>
                    <input id="user-old-password" name="oldPassword" type="password">
                </div>

                <div class="form-group">
                    <label for="user-new-password">新密碼</label>
                    <input id="user-new-password" name="password" type="password">
                </div>

                <div class="form-group">
                    <label for="user-confirm-new-password">確認新密碼</label>
                    <input id="user-confirm-new-password" name="passwordConfirmation" type="password">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">變更</button>
                </div>
            </fieldset>
        </form>
    </div>

    <script>
        $('input[type=file]').change(function () {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.img-thumbnail:first').attr('src', e.target.result);
            };
            reader.readAsDataURL(this.files[0]);
        });
    </script>

@endsection