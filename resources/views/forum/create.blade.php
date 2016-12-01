@extends('layout.basic')

@section('title', 'APAR - Register')

@section('header')
    @include('component.client-header')
    <link href="{{ asset('assets/css/forum.css') }}" rel="stylesheet">
@endsection

@section('content')

    @include('component.errors')
    @include('component.message')

    <div class="panel panel-default">
        <div class="panel-body">

            <form id="post-create" method="post" action="/forum/post">
                {{ csrf_field() }}

                <fieldset>
                    <legend>新增主題</legend>
                    <div class="form-group">
                        <label for="post-create-category"></label>
                        <select id="post-create-category" name="category">
                            @foreach($categories as $category)
                                <option value="{{ $category }}">{{ trans("category.{$category}") }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="post-create-title">主題</label>
                        <input name="title" id="post-create-title" placeholder="請輸入文章主題" value="{{ old('title') }}">
                    </div>

                    <div class="form-group">
                        <label for="post-create-content">內容</label>
                        <textarea class="form-create-text" name="content" id="post-create-content" placeholder="請輸入文章內容">{{ old('content') }}</textarea>
                    </div>

                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}"></div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">建立新文章</button>
                        <a href="{{ URL::previous() }}">
                            <button type="button" class="btn btn-danger">取消</button>
                        </a>
                    </div>
                </fieldset>
            </form>

        </div>
    </div>

    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script type="text/javascript">
        bkLib.onDomLoaded(function() {
            new nicEditor({
                fullPanel : true,
                iconsPath : '{{ asset('assets/vendor/nic/nicEditorIcons.gif') }}'
            }).panelInstance('post-create-content');
        });
    </script>

@endsection
