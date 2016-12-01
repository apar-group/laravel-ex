@extends('layout.basic')

@section('title', 'APAR-成員')

@section('header')
    @include('component.client-header')
@endsection

@section('content')

    {{--<table>--}}
        {{--<tbody>--}}
            {{--@if($teacher)--}}
            {{--<tr>--}}
                {{--<td>指導教授</td>--}}
                {{--<td><a href="/member/{{ $teacher->id }}">{{ $teacher->name }}</a></td>--}}
            {{--</tr>--}}
            {{--@endif--}}
            {{--@foreach($studentGroupByYear as $year => $students)--}}
            {{--<tr>--}}
                {{--<td>APAR {{ $year }} 級</td>--}}
                {{--@foreach($students as $student)--}}
                {{--<td><a href="/member/{{ $student->id }}">{{ $student->name }}</a></td>--}}
                {{--@endforeach--}}
            {{--</tr>--}}
            {{--@endforeach--}}
        {{--</tbody>--}}
    {{--</table>--}}

    <div class="row member-index-row">
        @if($teacher)
            <div class="col-md-3">
                <div class="member-index-p">
                    <img src="{{ asset("assets/images/member/{$teacher->photo}") }}">
                    <div class="name">
                        <span><h3><a href="/member/{{ $teacher->id }}">{{ $teacher->name }}</a></h3></span>
                        <span><h4>指導教授</h4></span>
                    </div>
                </div>
            </div>
        @endif
        @foreach($students as $student)
            <div class="col-md-3">
                <div class="member-index-p">
                    <img src="{{ asset("assets/images/member/{$student->photo}") }}">
                    <div class="name">
                        <span><h3><a href="/member/{{ $student->id }}">{{ $student->name }}</a></h3></span>
                        <span><h4>APAR {{ $student->year }} 級</h4></span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection