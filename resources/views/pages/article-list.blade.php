@extends('layouts.app')

@section('title', 'Article List')

@section('content')
    <div class="container article-list">
        <h1>/ 最新消息</h1>
        <div class="top-section">
            <div class="product-cates">
                <div class="btn-wrapper">
                    <input type="radio" id="option0" name="options" data-id="0" onclick="getArticleList()">
                    <label for="option0">所有</label>
                </div>
                @foreach($product_cates as $product_cate)
                    <div class="btn-wrapper">
                        <input type="radio" id="option{{$loop->index+1}}" name="options" data-id="{{@$product_cate->id}}" onclick="getArticleList()">
                        <label for="option{{$loop->index+1}}">{{$product_cate->name}}</label>
                    </div>
                @endforeach
            </div>

            <div class="search-line">
                <div class="row">
                    <div class="col-sm-12 col-md-8 search-input">
                        <input type="text" name="" id="search_letters" placeholder="搜尋" onchange="getArticleList()">
                    </div>
                    <div class="col-sm-12 col-md-4 article-cates">
                        @foreach($article_cates as $article_cate)
                        <label>
                            <input type="checkbox" class="chk-article_cat" name="options" value="{{$article_cate->id}}" data-id="{{@$article_cate->id}}" onclick="getArticleList()">
                            {{$article_cate->name}}
                        </label>                      
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    
        <div class="articles-result-section" id="articles_result_section">
        </div>

    </div>

@endsection
