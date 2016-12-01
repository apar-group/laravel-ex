@extends('layout.basic')

@section('title', 'APAR - Login')

@section('header')
    @include('component.client-header')
    <link href="{{ asset('assets/css/flat-form.css') }}" rel="stylesheet">
@endsection

@section('content')
    @include('component.errors')

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="col-md-8 col-lg-6 col-md-offset-2 col-lg-offset-3">

        <!-- START Forgot password form -->

        <div class="panel panel-form">

            <!-- Form header -->
            <div class="panel-heading">
                <h2 class="title">忘記密碼？</h2>
                <p>我們將會寄送重設密碼連結給您</p>
            </div>

            <div class="panel-body">
                <form role="form" method="post" action="{{ url('/password/email') }}">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <div class="input-group">
                            <div class="has-feedback has-left-icon">
                                <input name="email" type="email" class="form-control" id="email" placeholder="請輸入Email"  value="{{ old('email') }}">
                                <span class="fa fa-envelope form-control-feedback" aria-hidden="true"></span>
                            </div>
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-primary">發送郵件</button>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- END Forgot password form -->

    </div>
@endsection
