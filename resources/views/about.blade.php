@extends('layout.basic')

@section('title', 'APAR-關於')

@section('header')
    @include('component.client-header')
@endsection

@section('content')
    <div class="row">
        {{--banner--}}
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-1 about-title">
            <h1>我們是 APAR 創意無限研究群</h1>
            <ul>
                <li>
                    <a href="/contact">聯絡我們</a>
                </li>
            </ul>
        </div>
        <div class="col-md-5 col-md-offset-1 about-content">
            <h2>充滿想法、廣納人才、互助合作的團隊</h2>
            <p>APAR--適應體育運動研究群 (Adapted physical activity research)</p>
            <p>1999年7月吳昇光 教授自英國羅弗堡大學留學回台，將國外適應體育運動的觀念引進台灣，致力於推廣適應體育運動教育。</p>
            <p>2000年8月於中國醫藥大學物理治療學系成立此研究群，指導第一屆醫學所研究生，從事適應體育 運動的相關研究，開始推廣發展協調障礙兒童的相關研究主題。</p>
            <p>2004年融入多媒體影像記錄片的概念，並正名為『APAR創意無限』，試圖將枯燥文字的學術研究成果以紀錄片的方式呈現，以影片獨特的魅力來說服與推廣教育於社會大眾，使學術研究成果平民化，讓社會大眾從認識適應體育運動及發展協調障礙兒童開始，漸漸地重視這領域的發展。</p>
            <p>除了致力從事於教育之推廣，APAR 研究群的成員也在吳昇光老師的帶領與鼓勵之下，積極參與國內外的學術研討會，與各學術領域的友人從事學術研究的交流，拓展自己的視野。</p>
        </div>
    </div>
@endsection