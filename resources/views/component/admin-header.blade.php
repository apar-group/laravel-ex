@section('head')
<!-- Bootstrap Material Design -->
<link href="{{ asset('assets/vendor/bootstrap-material/css/bootstrap-material-design.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/bootstrap-material/css/ripples.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet">
@endsection

<div class="bs-component">
    <div class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">APAR</a>
            </div>
            <div class="navbar-collapse collapse navbar-responsive-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="/admin/news">News</a></li>
                    <li><a href="/admin/user">User</a></li>
                    <li><a href="/admin/forum/post">Forum</a></li>
                    <li><a href="/admin/member">Member</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/admin/logout">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
