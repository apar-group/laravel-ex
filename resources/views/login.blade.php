@extends('layout.basic')

@section('title', 'APAR - Login')

@section('header')
    @include('component.client-header')
    <link href="{{ asset('assets/css/flat-form.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="client-login">
        <div class="col-md-6 col-md-offset-3 col-sm-12">
            @include('component.errors')
            @include('component.message')
        </div>

        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="panel panel-form">
                    <!-- Form header -->
                    <div class="panel-heading">
                        <h2 class="title">登入</h2>
                        <p>第一次使用？<a href="{{ url('/register') }}">註冊</a>.</p>
                    </div>

                    <div class="panel-body">
                        <form  id="login" role="form" action="" method="post" class="login-form">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <!-- Username or email -->
                            <div class="form-group">
                                <label for="username" class="control-label">email</label>
                                <div class="has-feedback">
                                    <input name="email" type="email" class="form-control" id="username" value="{{ old('email') }}">
                                    <span class="fa fa-user form-control-feedback" aria-hidden="true"></span>
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="form-group">
                                <label for="password" class="control-label">Password</label>
                                <div class="has-feedback">
                                    <input name="password" type="password" class="form-control" id="password">
                                    <span class="fa fa-lock form-control-feedback" aria-hidden="true"></span>
                                </div>
                            </div>

                            <!-- Remember checkbox -->
                            {{--<div class="form-group">--}}
                            {{--<div class="checkbox">--}}
                            {{--<label class="custom-option toggle" data-off="OFF" data-on="ON">--}}
                            {{--<input type="checkbox" id="remember" name="remember" value="1">--}}
                            {{--<span class="button-checkbox"></span>--}}
                            {{--</label>--}}
                            {{--<label for="remember">Remember Me</label>--}}
                            {{--</div>--}}
                            {{--</div>--}}

                                    <!-- Logun button -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">登入</button>

                                <a class="btn btn-link" href="{{ url('/password/email') }}">忘記密碼？</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection