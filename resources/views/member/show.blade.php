@extends('layout.basic')

@section('title', 'APAR-成員資料')

@section('header')
    @include('component.client-header')
@endsection

@section('content')

    <div class="member-show-content">
        @if(Auth::user() && $member->user && Auth::user()->id == $member->user->id)
            <div class="row">
                <div class="col-md-2">
                    <h3>操作</h3>
                </div>
                <div class="col-md-4 member-show-btn">
                    <a href="{{ url("/member/{$member->id}/edit") }}"><button class="btn btn-default">編輯個人資料</button></a>
                </div>
            </div>
        @endif

        {{--<div class="row">--}}
            {{--<div class="col-md-2">--}}
                {{--<h3>個人照片</h3>--}}
            {{--</div>--}}
            {{--<div class="col-md-4 member-show-photo">--}}
                {{--<img src="{{ asset("assets/images/member/{$member->photo}") }}">--}}
            {{--</div>--}}
        {{--</div>--}}

        <div class="row">

        </div>

        <div class="row">
            <div class="col-md-8 member-photo-up">
                <div class="row">
                    <div class="col-md-3">
                        <h3><u>基本資料</u></h3>
                    </div>
                    <div class="col-md-9">
                        <div>
                            <h3>{{ $member->name }}</h3>
                        </div>
                        <div class="member-show-mail">
                            <img src="{{ asset("assets/images/mail.png") }}">
                            <h3>{{ $member->email }}</h3>
                        </div>
                        <div class="member-show-site">
                            <img src="{{ asset("assets/images/site.png") }}">
                            <h3>{{ $member->site }}</h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <h3><u>興趣</u></h3>
                    </div>
                    <div class="col-md-9">
                        <?php $hobbies = json_decode($member->hobbies) ? json_decode($member->hobbies) : [];?>
                        @foreach($hobbies as $hobby)
                            <div>
                                <h3>{{ $hobby }}</h3>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <h3><u>專長</u></h3>
                    </div>
                    <div class="col-md-9">
                        <?php $expertises = json_decode($member->expertise) ? json_decode($member->expertise) : [];?>
                        @foreach($expertises as $expertise)
                            <div>
                                <h3>{{ $expertise }}</h3>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <h3><u>證照</u></h3>
                    </div>
                    <div class="col-md-9">
                        <?php $qualifications = json_decode($member->qualifications) ? json_decode($member->qualifications) : [];?>
                        @foreach($qualifications as $qualification)
                            <div>
                                <h3>{{ $qualification }}</h3>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <h3><u>學歷</u></h3>
                    </div>
                    <div class="col-md-9">
                        <?php $educations = json_decode($member->education) ? json_decode($member->education) : [];?>
                        @foreach($educations as $education)
                            <div>
                                <h3>{{ $education }}</h3>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-4 member-show-photo">
                <img src="{{ asset("assets/images/member/{$member->photo}") }}">
            </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <h3><u>經歷</u></h3>
            </div>
            <div class="col-md-10">
                @foreach($member->experiences as $experience)
                    <div>
                        <h3>{{ $experience->start }}-{{ $experience->end }}  {{ $experience->company }} {{ $experience->title }}</h3>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <h3><u>著作</u></h3>
            </div>
            <div class="col-md-10">
                @foreach($member->publications as $publication)
                    <div>
                        <h4>{!! $publication->content !!}</h4>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 news-show-back">
                <a href="{{ URL::previous() }}"><img src="{{ asset('assets/images/arrow-back.png') }}"></a>
            </div>
        </div>
    </div>

@endsection
