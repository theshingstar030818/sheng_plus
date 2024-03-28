@extends('layouts.app')

@section('title', 'Welcome to Our Website')

@section('content')
    <div>
        I am a developer for this website. I lost my phone (whatsapp), so I could not contact to you.
        Here is my skype and email. Add me or send email to me. Sorry.
        <strong>
        skype:  live:.cid.146fcb5276d98dcf
        email: guruilya86@gmail.com
        </strong>
    </div>

    <div class="container product-cate-list">
        @foreach($product_cates as $product_cate)
        <div class="row product-cate-list-item {{$loop->index%2==1?'reversed-order':''}}">
            <div class="col-sm-12 col-md-6 item-left-col">
                <div class="left-border-yellow">
                    <h1 class="title">
                        {{@$product_cate->name}}
                    </h1>
                    <h4 class="description">
                        {{@$product_cate->description}}
                    </h4>
                </div>
                <div class="read-more">
                    <a href="" class="btn-type-01 font-size-22">{{__("Read More")}}</a>
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
