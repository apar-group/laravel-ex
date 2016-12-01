@extends('layout.basic')

@section('title', 'APAR - Login')

@section('header')
    @include('component.client-header')
    <link href="{{ asset('assets/css/flat-form.css') }}" rel="stylesheet">
@endsection

@section('content')
    @include('component.errors')

    <div class="col-md-8 col-lg-6 col-md-offset-2 col-lg-offset-3">

        <!-- START Forgot password form -->

        <div class="panel panel-form">

            <!-- Form header -->
            <div class="panel-heading">
                <h2 class="title">重設密碼</h2>
            </div>

            <div class="panel-body">
                <form role="form" method="post" action="{{ url('/password/reset') }}">
                    {!! csrf_field() !!}
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group">
                        <label for="username" class="control-label">email</label>
                        <div class="has-feedback">
                            <input name="email" type="email" class="form-control" id="username" value="{{ $email or old('email') }}">
                            <span class="fa fa-user form-control-feedback" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="password1" class="control-label">密碼</label>
                            <div class="has-feedback">
                                <input name="password" type="password" class="form-control" id="password1">
                                <span class="fa fa-lock form-control-feedback" aria-hidden="true"></span>
                            </div>
                            <p class="help-block">密碼長度至少8碼</p>
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="password2" class="control-label">再次輸入密碼</label>
                            <div class="has-feedback">
                                <input name="password_confirmation" type="password" class="form-control" id="password2">
                                <span class="fa fa-lock form-control-feedback" aria-hidden="true"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">重設密碼</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- END Forgot password form -->

    </div>
@endsection
