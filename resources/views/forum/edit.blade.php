@extends('layout.basic')

@section('title', "APAR-討論-編輯{$post->title}")

@section('header')
    @include('component.client-header')
    <link href="{{ asset('assets/css/forum.css') }}" rel="stylesheet">
@endsection

@section('content')

    @include('component.errors')
    @include('component.message')

    <div class="panel panel-default">
        <div class="panel-body">

            <form id="post-edit" method="post" action="/forum/post/{{ $post->id }}">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="put" />

                <fieldset>
                    <legend>新增文章</legend>

                    <div class="form-group">
                        <label for="post-create-category"></label>
                        <select id="post-create-category" name="category">
                            @foreach($categories as $category)
                                <option value="{{ $category }}" @if ($category == $post->category) selected @endif>{{ trans("category.{$category}") }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="post-create-title">主題</label>
                        <input name="title" id="post-create-title" placeholder="請輸入文章主題" value="{{ old('title', $post->title) }}">
                    </div>

                    <div class="form-group">
                        <label for="post-create-content">內容</label>
                        <textarea class="form-edit-text" name="content" id="post-edit-content" placeholder="請輸入文章主題">{{ old('content', $post->content) }}</textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">更新文章</button>
                        <a href="{{ URL::previous() }}">
                            <button type="button" class="btn btn-danger">取消</button>
                        </a>
                    </div>
                </fieldset>
            </form>

        </div>
    </div>

    <script type="text/javascript">
        bkLib.onDomLoaded(function() {
            new nicEditor({
                fullPanel : true,
                iconsPath : '{{ asset('assets/vendor/nic/nicEditorIcons.gif') }}'
            }).panelInstance('post-edit-content');
        });
    </script>

@endsection
