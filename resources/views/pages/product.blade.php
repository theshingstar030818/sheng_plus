@extends('layouts.app')

@section('title', 'Welcome to Our Website')

@section('content')
    <div id="product_content_tab_one" style="display:none;">
        {{$product->tab_one}}
    </div>
    <div id="product_content_tab_two" style="display:none;">
        {{$product->tab_two}}
    </div>
    <div id="product_content_tab_three" style="display:none;">
        {{$product->tab_three}}
    </div>
    <div id="product_content_tab_four" style="display:none;">
        {{$product->tab_four}}
    </div>

    <div class="container product-detail">
        <div class="row first-line">
            <div class="col-sm-12 col-md-5 left-side">
                <div class="image-container">
                    @foreach(json_decode($product->imgs) as $img)
                        @if($loop->index == 0)
                            <img src="{{getFullImageAddressFromAttachmentId($img)}}" class="image active">
                        @else
                            <img src="{{getFullImageAddressFromAttachmentId($img)}}" class="image">
                        @endif
                    @endforeach
                </div>
                <div class="circle-container">
                    @foreach(json_decode($product->imgs) as $img)
                        @if($loop->index == 0)
                            <div class="circle active" onclick="showImage({{$loop->index}})"></div>
                        @else
                            <div class="circle" onclick="showImage({{$loop->index}})"></div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="col-sm-12 col-md-7 right-side">
                <h2 class="title left-border-yellow">
                    {{$product->name}}
                </h2>
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
        <div class="second-line">
            <div class="tab">
                <button class="tablinks" onclick="openTab(event, 'Tab1', 'product_content_tab_one')">技術參數</button>
                <button class="tablinks" onclick="openTab(event, 'Tab2', 'product_content_tab_two')">內部結構</button>
                <button class="tablinks" onclick="openTab(event, 'Tab3', 'product_content_tab_three')">產品優勢</button>
                <button class="tablinks" onclick="openTab(event, 'Tab4', 'product_content_tab_four')">產品應用</button>
            </div>

            <div id="Tab1" class="tabcontent">
                <div class="text-content" id="product_content_tab_one_html">
                </div>
                <div class="img-content">
                    <img src="{{getFullImageAddressFromAttachmentId($product->tab_one_img)}}" alt="">
                </div>
            </div>

            <div id="Tab2" class="tabcontent" id="product_content_tab_two_html">
                <div class="text-content">
                </div>
                <div class="img-content">
                    <img src="{{getFullImageAddressFromAttachmentId($product->tab_two_img)}}" alt="">
                </div>
            </div>

            <div id="Tab3" class="tabcontent" id="product_content_tab_three_html">
                <div class="text-content">
                </div>
                <div class="img-content">
                    <img src="{{getFullImageAddressFromAttachmentId($product->tab_three_img)}}" alt="">
                </div>
            </div>

            <div id="Tab4" class="tabcontent" id="product_content_tab_four_html">
                <div class="text-content">
                </div>
                <div class="img-content">
                    <img src="{{getFullImageAddressFromAttachmentId($product->tab_four_img)}}" alt="">
                </div>
            </div>
        </div>

        <div class="btn-return" onclick="goToPreviousPage();">
            <a href="#" class="btn-type-01" onclick="goToPreviousPage()">返回</a>
        </div>
    </div>
@endsection
