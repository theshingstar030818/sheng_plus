@extends('layouts.app')

@section('title', 'Welcome to Our Website')

@section('content')
    <div class="container product-cate-list">
        @foreach($product_cates as $product_cate)
        <div class="row product-cate-list-item {{$loop->index%2==1?'reversed-order':''}}">
            <div class="col-sm-12 col-md-6 item-left-col">
                <div class="left-border-yellow">
                    <h2 class="title">
                        {{@$product_cate->name}}
                    </h2>
                    <div class="description">
                        {{@$product_cate->description}}
                    </div>
                </div>
                <div class="read-more">
                    <a href="" class="btn-type-01">{{__("Read More")}}</a>
                </div>
                <a href="" class="link-for-the-page">www.shengplus.com.tw.flapdisc</a>
            </div>
            <div class="col-sm-12 col-md-6 item-right-col">
                <a href="{{ url('/product-cate/'.$product_cate->id.'/0')}}">
                    <img src="{{getFullImageAddressFromAttachmentId($product_cate->img)}}" alt="">
                </a>
            </div>
        </div>
        @endforeach
    </div>
@endsection
