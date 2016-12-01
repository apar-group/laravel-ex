<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <script src="{{ asset('assets/vendor/nic/nicEdit.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-1.12.1.min.js') }}"></script>
    <link href="{{ asset('assets/vendor/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        .btn-file {
            position: relative;
            overflow: hidden;
        }
        .btn-file input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            min-width: 100%;
            min-height: 100%;
            font-size: 100px;
            text-align: right;
            filter: alpha(opacity=0);
            opacity: 0;
            outline: none;
            background: white;
            cursor: inherit;
            display: block;
        }
    </style>
    @yield('head')
</head>
<body>

<header>
    @yield('header')
</header>

<div class="content-out">
    <div class="container-fluid">
        @yield('content-fluid')
    </div>
    <div class="container">
        @yield('content')
    </div>
</div>

<footer>
    @yield('footer')
</footer>

<script src="{{ asset('assets/vendor/bootstrap/bootstrap.min.js') }}"></script>

</body>
</html>
