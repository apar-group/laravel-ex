@extends('layout.basic')

@section('title', 'APAR - Register')

@section('header')
    @include('component.client-header')
@endsection

@section('content')

    @include('component.errors')
    @include('component.message')

    <form class="form-horizontal" method="post" action="/member/{{ $member->id }}/upload" enctype="multipart/form-data">
        {{ csrf_field() }}
        <legend class="col-md-12">頭像</legend>
        <div class="form-group">
            <div class="col-md-3">
                <img class="img-thumbnail" src='{{ asset("assets/images/member/$member->photo") }}'>
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
    </form>

    <form id="member" method="post" action="/member/{{ $member->id }}">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="put" />

        <label for="name">姓名</label>
        <input name="name" id="name" placeholder="John" value={{ $member->name }}>

        <label for="email">電子郵件</label>
        <input name="email" id="email" type="email" placeholder="abc@domain.com" value={{ $member->email }}>

        @if($member->year > 0)
        <label for="year">APAR級數</label>
        <select name="year" id="year">
            @for($i = 89; $i < (date("Y") - 1911); $i++)
                <option value="{{ $i }}" @if($i == $member->year) selected @endif>{{ $i }}</option>
            @endfor
        </select>
        @endif

        <label for="site">個人網站</label>
        <input name="site" id="site" value={{ $member->site }}>

        <label>
            興趣
            <?php $hobbies = json_decode($member->hobbies) ? json_decode($member->hobbies) : [""];?>
            @foreach($hobbies as $hobby)
                <input name="hobbies[]" value={{ $hobby }}>
            @endforeach
            <button type="button" name="add-row">+</button>
        </label>

        <label>
            專長
            <?php $expertises = json_decode($member->expertise) ? json_decode($member->expertise) : [""];?>
            @foreach($expertises as $expertise)
                <input name="expertise[]" value={{ $expertise }}>
            @endforeach
            <button type="button" name="add-row">+</button>
        </label>

        <label>
            證照
            <?php $qualifications = json_decode($member->qualifications) ? json_decode($member->qualifications) : [""];?>
            @foreach($qualifications as $qualification)
                <input name="qualifications[]" value={{ $qualification }}>
            @endforeach
            <button type="button" name="add-row">+</button>
        </label>

        <label class="draggable">
            學歷
            <?php $educations = json_decode($member->education) ? json_decode($member->education) : [""];?>
            @foreach($educations as $education)
                <input name="education[]" value={{ $education }}>
            @endforeach
            <button type="button" name="add-row">+</button>
        </label>

        <button type="submit">更新</button>
    </form>

    <script>
        $('input[type=file]').change(function () {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.img-thumbnail:first').attr('src', e.target.result);
            };
            reader.readAsDataURL(this.files[0]);
        });
        $("button[name=add-row]").click(function() {
            var prevNode = $(this).prev();
            prevNode.clone().val("").insertAfter(prevNode);
        });
        // todo draggable
    </script>

@endsection
