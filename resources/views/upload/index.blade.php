<form class="form-horizontal" method="post" action="/upload/{{ $user->id }}" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <fieldset>
        <legend class="col-md-12">頭像</legend>

        <div class="form-group">
            <div class="col-md-3">
                {!! $user->photo !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-3">
        <span class="btn btn-default btn-file">
            選擇檔案 <input name="image" type="file">
        </span>
                <button type="submit" class="btn btn-primary">更新</button>
            </div>
        </div>
    </fieldset>

</form>