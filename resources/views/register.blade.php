@extends('layout.basic')

@section('title', 'APAR - Register')

@section('header')
    @include('component.client-header')
    <link href="{{ asset('assets/css/flat-form.css') }}" rel="stylesheet">
@endsection

@section('content')

    @include('component.errors')

    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-form">
            <!-- Registration header -->
            <div class="panel-heading">
                <h2 class="title">註冊</h2>
                <p>已經有帳號了？ <a href="{{ url('/login') }}">登入</a>.</p>
            </div>

            <div class="panel-body">
                <form role="form"  id="register" method="post" action="/user">
                    {{ csrf_field() }}
                    <!-- Username and email -->
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="username" class="control-label">帳號</label>
                            <div class="has-feedback">
                                <input name="name" type="text" class="form-control" id="username" value="{{ old('name') }}">
                                <span class="fa fa-user form-control-feedback" aria-hidden="true"></span>
                            </div>
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="email" class="control-label">電子郵件</label>
                            <div class="has-feedback">
                                <input name="email" type="email" class="form-control" id="email" value="{{ old('email') }}">
                                <span class="fa fa-envelope form-control-feedback" aria-hidden="true"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Passwords -->
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

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <div class="g-recaptcha" data-sitekey="{{ Config::get('captcha.re_cap_site') }}"></div>
                        </div>
                    </div>

                    <!-- Static agree text -->
                    {{--<div class="form-group">--}}
                        {{--<p class="form-control-static">--}}
                            {{--Do you agree to the <a href="#">User Agreement</a> and <a href="#">Privacy Policy</a>?--}}
                        {{--</p>--}}
                    {{--</div>--}}

                    <!-- Registration button -->
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">建立帳號</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src='https://www.google.com/recaptcha/api.js'></script>
@endsection
