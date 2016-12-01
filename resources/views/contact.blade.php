@extends('layout.basic')

@section('title', 'APAR-首頁')

@section('header')
    @include('component.client-header')
    <style>
        .content-out {
            padding-top: 0;
        }
    </style>
@endsection

@section('content-fluid')
    <div class="row">
        <div class="col-md-12 contact-map">
            <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3640.6493429581956!2d120.68523191564644!3d24.148949779349344!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x34693d68485c5c2b%3A0x4c9bc2070b501e2b!2zNDA05Y-w5Lit5biC5YyX5Y2A6ZuZ5Y2B6Lev5LiA5q61MTbomZ8!5e0!3m2!1szh-TW!2stw!4v1463105970829" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
    </div>
@endsection

@section('content')
    <div class="row contact-address">
        <div class="col-md-3 col-md-offset-2">
            <h1>台中市北區 404 雙十路一段16號 國立台灣體育運動大學 運科中心</h1>
        </div>
        <div class="col-md-4 col-md-offset-1">
            <p>想加入我們的研究團隊？或是有研究提案想與我們合作，歡迎利用下列電子郵件信箱與我們聯繫</p>
            <p>
                <strong>聯絡方式</strong>
                <br>
                <a href="mailto:aparntupes@gmail.com">aparntupes@gmail.com</a>
            </p>
        </div>
    </div>
@endsection
