@extends('layouts.app')

@section('title', 'Welcome to Our Website')

@section('content')
    <div class="container product-cate-detail">
        <div class="top-tab">
            <div class="left-side">
                <div class="tab-item {{$selected_tab==0?'selected':''}}">
                    <a href="{{ url('/product-cate/'.$product_cate_selected->id.'/0') }}">首頁</a>
                </div>
                <div class="tab-item {{$selected_tab==1?'selected':''}}">
                    <a href="{{ url('/product-cate/'.$product_cate_selected->id.'/1') }}">關於我們</a>
                </div>
                <div class="tab-item {{$selected_tab==2?'selected':''}}">
                    <a href="{{ url('/product-cate/'.$product_cate_selected->id.'/2') }}">產品</a>
                </div>
                <div class="tab-item {{$selected_tab==3?'selected':''}}">
                    <a href="{{ url('/product-cate/'.$product_cate_selected->id.'/3') }}">資源</a>
                </div>
                <div class="tab-item {{$selected_tab==4?'selected':''}}">
                    <a href="{{ url('/article-list') }}">最新消息</a>
                </div>
            </div>
            <div class="right-side">
                <input type="text" name="" id="" placeholder="search">
            </div>
        </div>    
        
        
        <div class="top-banner-img">
            <img src="{{ asset('images/top-banner-01.png') }}" alt="">
        </div>

        @if($selected_tab == 0)

        <div class="product-sub-categories">
            @foreach($product_sub_cates as $product_sub_cate)
                <div class="item">
                    {{$product_sub_cate->name}}
                </div>
            @endforeach
        </div>

        <div class="row product-category-card">
            <div class="col-sm-12 col-md-5 left-side">
                <img src="{{getFullImageAddressFromAttachmentId($product_cate_selected->img)}}" alt="">
            </div>
            <div class="col-sm-12 col-md-7 right-side">
                <h2 class="title">{{$product_cate_selected->name}}</h2>
                <div class="dimension">{{$product_cate_selected->name}}</div>
                <div class="description">{{$product_cate_selected->description}}</div>
                <a href="{{ url('/product-cate/'.$product_cate_selected->id.'/2') }}" class="btn-type-01">了解更多</a>
            </div>
        </div>

        <div class="articles-short-list">
            <h4 class="title">最新消息</h4>
            @foreach($articles_related as $article)
                <div class="row article-item" onclick="goToURL('{{ url('/article/'.$article->id) }}')">
                    <div class="col-sm-5 col-md-2 left-side">
                        <div class="date">
                            {{formatDateDD($article->published_date)}}    
                        </div>
                        <div class="YYYY-mm">
                            {{formatDateYYYYmm($article->published_date)}}    
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-10 right-side">
                        <div class="first-line">
                            {{$article->title}}
                        </div>
                        <div class="second-line">
                            {{substr($article->content, 0, 50)}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @elseif($selected_tab == 2)
        <div class="products-view">
            <div class="row">
                <div class="col-sm-12 col-md-4 left-side">
                @foreach($product_sub_cates as $product_sub_cate)
                    <h4 class="sub-cate-item {{$loop->index==0?'selected':''}}" data-id="{{$product_sub_cate->id}}" onclick="getProductList(event)">
                        {{$product_sub_cate->name}}&nbsp;>
                    </h4>
                @endforeach
                </div>
                <div class="col-sm-12 col-md-8 right-side">
                    <div class="first-line">

                    </div>
                    <div class="second-line" id="products_view_result">

                    </div>
                </div>
            </div>
        </div>
        @endif

    </div>


 


@endsection
