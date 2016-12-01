@extends('layout.basic')

@section('title', 'APAR - 新增最新消息')

@section('header')
    @include('component.admin-header')
@endsection

@section('content')

    @include('component.errors')
    @include('component.message')

    <div class="well bs-component">
        <form class="form-horizontal" id="add-news" method="post" action="/admin/news">
            {{ csrf_field() }}
            <fieldset>
                <legend>新增最新消息</legend>
                <div class="form-group">
                    <label for="title" class="col-md-2 control-label">標題</label>

                    <div class="col-md-10">
                        <input name="title" id="title" class="form-control" placeholder="請輸入標題" value="{{ old('title') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="news-content" class="col-md-2 control-label">內容</label>
                    <div class="col-md-10">
                        <textarea name="content" id="news-content" class="form-control" placeholder="請輸入內容">{{ old('content') }}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-10 col-md-offset-2">
                        <button type="submit" class="btn btn-primary">確認</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>

    <script>
        bkLib.onDomLoaded(function() {
            new nicEditor({
                fullPanel : true,
                iconsPath : '{{ asset('assets/vendor/nic/nicEditorIcons.gif') }}'
            }).panelInstance('news-content');
        });
    </script>

@endsection
