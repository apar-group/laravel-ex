@extends('layout.basic')

@section('title', 'APAR - Register')

@section('header')
    @include('component.admin-header')

    <style>
        .switch-target .row {
            border-bottom: 1px solid #ddd;
            padding-bottom: 8px;
            margin: 0 auto;
        }

        .switch-target .row:last-child {
            margin-bottom: 30px;
        }

        .switch-target .row:nth-of-type(even) {
            background: #f9f9f9;
        }
    </style>
@endsection

@section('content')

    @include('component.errors')
    @include('component.message')

    <h2>更新研究群成員</h2>

    <div class="well bs-component">
        <form class="form-horizontal" method="post" action="/admin/member/{{ $member->id }}/upload" enctype="multipart/form-data">
            {{ csrf_field() }}
            <legend>頭像</legend>
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
    </div>

    <div class="well bs-component">
        <form class="form-horizontal" id="member" method="post" action="/admin/member/{{ $member->id }}">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="put" />
            <legend>
                基本資料
                <button type="button" name="switch" class="btn btn-primary">opened</button>
            </legend>
            <fieldset class="switch-target">
                <div class="form-group">
                    <label for="name" class="col-md-2 control-label">姓名</label>

                    <div class="col-md-10">
                        <input name="name" id="name" class="form-control" placeholder="John" value={{ $member->name }}>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputEmail" class="col-md-2 control-label">電子郵件</label>

                    <div class="col-md-10">
                        <input name="email" type="email" class="form-control" id="inputEmail" placeholder="Email" value={{ $member->email }}>
                    </div>
                </div>

                <div class="form-group">
                    <label for="user_id" class="col-md-2 control-label">連結使用者</label>

                    <div class="col-md-10">
                        <select name="user_id" id="user_id"  class="form-control">
                            <option value="">無</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" @if($user->id == $member->user_id) selected @endif>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="year" class="col-md-2 control-label">APAR級數</label>

                    <div class="col-md-10">
                        @if($member->year == 0)
                            <select name="year" id="year"  class="form-control">
                                <option>0</option>
                            </select>
                        @else
                            <select name="year" id="year"  class="form-control">
                                @for($i = 89; $i < (date("Y") - 1911); $i++)
                                    <option value="{{ $i }}" @if($i == $member->year) selected @endif>{{ $i }}</option>
                                @endfor
                            </select>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="site" class="col-md-2 control-label">個人網站</label>

                    <div class="col-md-10">
                        <input name="site" id="site" class="form-control" value={{ $member->site }}>
                    </div>
                </div>

                <div class="form-group">
                    <label for="hobbies" class="col-md-2 control-label">興趣</label>

                    <div class="col-md-10">
                        <?php $hobbies = json_decode($member->hobbies) ? json_decode($member->hobbies) : [""];?>
                        @foreach($hobbies as $hobby)
                            <input name="hobbies[]" id="hobbies" class="form-control" value={{ $hobby }}>
                        @endforeach
                        <button type="button" name="add-row">+</button>
                    </div>
                </div>

                <div class="form-group">
                    <label for="expertise" class="col-md-2 control-label">專長</label>

                    <div class="col-md-10">
                        <?php $expertises = json_decode($member->expertise) ? json_decode($member->expertise) : [""];?>
                        @foreach($expertises as $expertise)
                            <input name="expertise[]" id="expertise" class="form-control" value={{ $expertise }}>
                        @endforeach
                        <button type="button" name="add-row">+</button>
                    </div>
                </div>

                <div class="form-group">
                    <label for="qualifications" class="col-md-2 control-label">證照</label>

                    <div class="col-md-10">
                        <?php $qualifications = json_decode($member->qualifications) ? json_decode($member->qualifications) : [""];?>
                        @foreach($qualifications as $qualification)
                            <input name="qualifications[]" id="qualifications" class="form-control" value={{ $qualification }}>
                        @endforeach
                        <button type="button" name="add-row">+</button>
                    </div>
                </div>

                <div class="form-group">
                    <label for="education" class="col-md-2 control-label">學歷</label>

                    <div class="col-md-10">
                        <?php $educations = json_decode($member->education) ? json_decode($member->education) : [""];?>
                        @foreach($educations as $education)
                            <input name="education[]" id="education" class="form-control" value={{ $education }}>
                        @endforeach
                        <button type="button" name="add-row">+</button>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-10 col-md-offset-2">
                        <button type="submit" class="btn btn-primary">更新</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>

    <div class="well bs-component">
        <h3>
            經歷
            <button type="button" name="switch" class="btn btn-primary">opened</button>
        </h3>
        <div>
            <table class="table table-striped table-hover switch-target">
                <thead>
                    <tr>
                        <th>服務單位</th>
                        <th>頭銜</th>
                        <th>開始時間</th>
                        <th>結束時間</th>
                        <th>操作</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($member->experiences as $experience)
                    <tr>
                        <form id="update-{{ $experience->id }}" action="/admin/experience/{{ $experience->id }}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="put" />
                            <td><input name="company" class="form-control" value="{{ $experience->company }}"></td>
                            <td><input name="title" class="form-control" value="{{ $experience->title }}"></td>
                            <td><input name="start" class="form-control" value="{{ $experience->start }}"></td>
                            <td><input name="end" class="form-control" value="{{ $experience->end }}"></td>
                        </form>
                        <td>
                            <button form="update-{{ $experience->id }}" class="btn btn-raised btn-success">Edit</button>
                        </td>
                        <td>
                            <form action="/admin/experience/{{$experience->id}}" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="delete" />
                                <input type="submit" class="btn btn-raised btn-danger" value="刪除">
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <form class="form-horizontal" id="experience" method="post" action="/admin/experience">
            {{ csrf_field() }}
            <input type="hidden" name="member_id" value="{{ $member->id }}" />
            <fieldset class="switch-target">
                <legend>新增經歷</legend>
                <div class="form-group">
                    <label for="company" class="col-md-2 control-label">服務單位</label>
                    <div class="col-md-10">
                        <input name="company" id="company" class="form-control" value="{{ old('company') }}">
                    </div>
                    <label for="title" class="col-md-2 control-label">頭銜</label>
                    <div class="col-md-10">
                        <input name="title" id="title" class="form-control" value="{{ old('title') }}">
                    </div>
                    <label for="start" class="col-md-2 control-label">開始時間</label>
                    <div class="col-md-10">
                        <input name="start" id="start" class="form-control" value="{{ old('start') }}">
                    </div>
                    <label for="end" class="col-md-2 control-label">結束時間</label>
                    <div class="col-md-10">
                        <input name="end" id="end" class="form-control" value="{{ old('end') }}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-10 col-md-offset-2">
                        <button type="submit" class="btn btn-primary">新增</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>

    <div class="well bs-component">
        <h3>
            著作
            <button type="button" name="switch" class="btn btn-primary">opened</button>
        </h3>
        <div class="switch-target">
            <div class="row">
                <div class="col-md-9">列表</div>
                <div class="col-md-1">操作</div>
                <div class="col-md-2"></div>
            </div>
            @foreach($member->publications as $publication)
            <div class="row">
                <div class="col-md-9 col-xs-12">
                    <form id="update-publication-{{ $publication->id }}" action="/admin/publication/{{ $publication->id }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="put" />
                        <input name="year" class="form-control" value="{{ $publication->year }}">
                        <textarea name="content" id="publication-content-{{ $publication->id }}" class="form-control">{{ $publication->content }}</textarea>
                    </form>
                </div>
                <div class="col-md-1 col-xs-4">
                    <button form="update-publication-{{ $publication->id }}" class="btn btn-raised btn-success">Edit</button>
                </div>
                <div class="col-md-2 col-xs-8">
                    <form action="/admin/publication/{{$publication->id}}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="delete" />
                        <input type="submit" class="btn btn-raised btn-danger" value="刪除">
                    </form>
                </div>
            </div>
            @endforeach
        </div>

        <form class="form-horizontal" id="publication" method="post" action="/admin/publication">
            {{ csrf_field() }}
            <input type="hidden" name="member_id" value="{{ $member->id }}" />
            <fieldset class="switch-target">
                <legend>新增著作</legend>
                <div class="form-group">
                    <label for="publication-year" class="col-md-2 control-label">時間</label>
                    <div class="col-md-10">
                        <input name="year" id="publication-year" class="form-control" value="{{ old('year') }}">
                    </div>
                    <label for="publication-content" class="col-md-2 control-label">內容</label>
                    <div class="col-md-10">
                        <textarea name="content" id="publication-content" class="form-control" placeholder="請輸入文章內容">{{ old('content') }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-10 col-md-offset-2">
                        <button type="submit" class="btn btn-primary">新增</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>

    <script>
        $("button[name=add-row]").click(function() {
            var prevNode = $(this).prev();
            prevNode.clone().val("").insertAfter(prevNode);
        });
        $("button[name=switch]").click(function() {
            var switchBtn = $(this);
            switchBtn.text() === 'opened' ? switchBtn.text('closed') : switchBtn.text('opened');
            switchBtn.parent().parent().find('.switch-target').toggle();
            switchBtn.toggleClass('btn-primary');
            switchBtn.toggleClass('btn-default');
        });
        $('input[type=file]').change(function () {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.img-thumbnail:first').attr('src', e.target.result);
            };
            reader.readAsDataURL(this.files[0]);
        });
        bkLib.onDomLoaded(function() {
            new nicEditor({
                iconsPath : '{{ asset('assets/vendor/nic/nicEditorIcons.gif') }}',
                buttonList : ['fontSize','bold','italic','underline']
            }).panelInstance('publication-content');
        });
        @foreach($member->publications as $publication)
        bkLib.onDomLoaded(function() {
            new nicEditor({
                iconsPath : '{{ asset('assets/vendor/nic/nicEditorIcons.gif') }}',
                buttonList : ['fontSize','bold','italic','underline']
            }).panelInstance('publication-content-{{ $publication->id }}');
        });
        @endforeach
    </script>

@endsection
