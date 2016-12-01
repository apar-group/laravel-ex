@extends('layout.basic')

@section('title', 'APAR - Login')

@section('content')

    @include('component.errors')
    @include('component.message')

    <div class="login-container well bs-component">
        <form class="form-signin" id="login" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <h2 class="form-signin-heading">Please sign in</h2>
            <label for="email" class="sr-only">電子郵件</label>
            <input name="email" id="email" type="email" class="form-control" placeholder="Email address" required="" autofocus="" value="{{ old('email') }}">
            <label for="password" class="sr-only">Password</label>
            <input name="password" id="password" type="password" class="form-control" placeholder="Password" required="">
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="remember-me">
                    <span class="checkbox-material"><span class="check"></span></span>
                    Remember me
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        </form>
    </div>

@endsection