@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
    <div class="container">
        <h1>/ 聯絡我們</h1>
        <div class="row contact-info-section">
            <div class="col-sm-12 col-md-5 left-side">
                <img src="{{ asset('images/contact-us-main.png') }}" alt="">
            </div>
            <div class="col-sm-12 col-md-7 right-side">
                <h4 class="company-name line">
                    亞皇實業有限公司<br/>
                    SHENPLUS Technology Co., LTD.
                </h4>
                <div class="phone line">
                    Phone: 07-7252768
                </div>
                <div class="fax line">
                    Fax: 07-7251508
                </div>
                <div class="third-info line">統編: 27222574</div>
                <div class="address line">
                    地址: 802026高雄市苓雅區四維一路164號
                </div>

                <form action="{{ url('/') }}" method="POST">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 form-line">
                            <input type="text" name="" id="" placeholder="公司名稱">
                            <input type="text" name="" id="" placeholder="客戶名稱">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6 form-line">
                            <input type="text" name="" id="" placeholder="公司名稱">
                            <input type="text" name="" id="" placeholder="客戶名稱">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 form-line">
                            <input type="text" name="" id="" placeholder="公司名稱">
                        </div>
                        <div class="col-sm-12 col-md-12 form-line">
                            <textarea name="" id="" cols="30" rows="10" placeholder="留言"></textarea>
                        </div>
                        <div class="col-sm-12 col-md-12 form-line">
                            <a href="{{ url('/') }}" class="btn-type-01">送出</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row email-section">
            <div class="col-sm-12 col-md-6 inner-wrapper">
                <h3 class="title">
                〔 EDM訂閱〕
                </h3>
                <div class="email-wrapper">
                    <input type="email" name="" id="" placeholder="Email">
                    <a href="{{ url('/') }}" class="btn-type-02">訂閱</a>
                </div>
            </div>
        </div>

        <div class="row map-section">
            <img src="{{ asset('images/contact-us-map.png') }}" alt="">
        </div>
    </div>
@endsection
