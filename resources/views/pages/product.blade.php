@extends('layouts.app')

@section('title', 'Welcome to Our Website')

@section('content')
    <div class="container product-detail">
        <div class="row first-line">
            <div class="col-sm-12 col-md-5 left-side">
                <img src="{{getFullImageAddressFromAttachmentId(json_decode($product->imgs)[0])}}" alt="">
            </div>
            <div class="col-sm-12 col-md-7 right-side">
                <div class="title">
                    {{$product->name}}
                </div>
                <div class="dimension">
                    {{$product->dimension??''}}
                </div>
                <div class="desc">
                    {{$product->desc}}
                </div>
                <div class="add-to-shopping-cart">
                    <a href="#" class="btn-type-01">加入詢價</a>
                </div>
            </div>
        </div>
        <div class="secont-line">
            <div class="tab">
                <button class="tablinks" onclick="openTab(event, 'Tab1')">技術參數</button>
                <button class="tablinks" onclick="openTab(event, 'Tab2')">內部結構</button>
                <button class="tablinks" onclick="openTab(event, 'Tab3')">產品優勢</button>
                <button class="tablinks" onclick="openTab(event, 'Tab4')">產品應用</button>
            </div>

            <div id="Tab1" class="tabcontent">
                <div class="text-content">
                    {{$product->tab_one}}
                </div>
                <div class="img-content">
                    <img src="{{getFullImageAddressFromAttachmentId($product->tab_one_img)}}" alt="">
                </div>
            </div>

            <div id="Tab2" class="tabcontent">
                <div class="text-content">
                    {{$product->tab_two}}
                </div>
                <div class="img-content">
                    <img src="{{getFullImageAddressFromAttachmentId($product->tab_two_img)}}" alt="">
                </div>
            </div>

            <div id="Tab3" class="tabcontent">
                <div class="text-content">
                    {{$product->tab_three}}
                </div>
                <div class="img-content">
                    <img src="{{getFullImageAddressFromAttachmentId($product->tab_three_img)}}" alt="">
                </div>
            </div>

            <div id="Tab4" class="tabcontent">
                <div class="text-content">
                    {{$product->tab_four}}
                </div>
                <div class="img-content">
                    <img src="{{getFullImageAddressFromAttachmentId($product->tab_four_img)}}" alt="">
                </div>
            </div>
        </div>

        <div class="btn-return">
            <a href="#" class="btn-type-01" onclick="goToPreviousPage()">返回</a>
        </div>
    </div>
@endsection
