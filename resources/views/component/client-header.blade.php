@section('head')
    <link href="{{ asset('assets/css/client.css') }}" rel="stylesheet">
@endsection

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/"><img src="http://www.newblack.me/img/logo.svg"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/about">關於</a></li>
                <li><a href="/research">研究</a></li>
                <li><a href="/news">消息</a></li>
                <li><a href="/forum">討論</a></li>
                <li><a href="/member">成員</a></li>
                <li><a href="/contact">聯絡</a></li>
                @if (! empty(Auth::user()))
                <li class="navbar-li-font-color"><a href="/profile">帳戶</a></li>
                <li class="navbar-li-font-color"><a href="/logout">登出</a></li>
                @else
                <li class="navbar-li-font-color"><a href="/login">登入</a></li>
                <li class="navbar-li-font-color"><a href="/register">註冊</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
