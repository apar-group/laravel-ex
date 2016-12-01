@extends('layout.basic')

@section('title', 'APAR - Register')

@section('header')
    @include('component.admin-header')
@endsection

@section('content')

    @include('component.errors')
    @include('component.message')

    <div class="well bs-component">
        <form id="news-edit" method="post" action="/admin/news/{{ $news->id }}">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="put" />
            <fieldset>
                <legend>更新最新消息</legend>
                <div class="form-group">
                    <label for="title" class="col-md-2 control-label">標題</label>

                    <div class="col-md-10">
                        <input name="title" id="title" class="form-control" placeholder="請輸入標題" value="{{ old('title', $news->title) }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="news-content" class="col-md-2 control-label">內容</label>
                    <div class="col-md-10">
                        <textarea name="content" id="news-content" class="form-control" placeholder="請輸入內容">{{ old('content', $news->content) }}</textarea>
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

    <script type="text/javascript">
        bkLib.onDomLoaded(function() {
            new nicEditor({
                fullPanel : true,
                iconsPath : '{{ asset('assets/vendor/nic/nicEditorIcons.gif') }}'
            }).panelInstance('news-content');
        });
    </script>

@endsection
