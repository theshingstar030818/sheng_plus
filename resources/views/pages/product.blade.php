@extends('layouts.app')

@section('title', 'Article List')

@section('content')
    <div class="container article-detail">
        <div class="first-line">
            <h2>Latest News</h2>  
            <h5 class="article-title">最新消息</h5>
        </div>
        <div class="row article-header">
            <div class="col-sm-12 col-md-6 left-side">        
                <span class="published-date">{{formatDate($article->published_date)}}</span>
                <h3 class="article-title">{{$article->title}}</h3>
            </div>
            <div class="col-sm-12 col-md-6 right-side">
                <div class="social-icons">
                    <a href="https://www.facebook.com/yourprofile" target="_blank"><i class="fa-brands fa-facebook"></i></a>
                    <a href="https://twitter.com/yourprofile" target="_blank"><i class="fa-brands fa-twitter"></i></a>
                    <a href="https://www.instagram.com/yourprofile" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                </div>
            </div>
        </div>

        <div class="row article-content-wrapper">
            <div class="col-sm-12 col-md-8 left-side">
                <h3 class="article-title">
                    {{$article->title}}
                </h3>
                <div class="article-content">
                    {{$article->content}}
                </div>
            </div>
            <div class="col-sm-12 col-md-4 right-side">
                <div class="article-img">
                    <img src="{{getFullImageAddressFromAttachmentId($article->img)}}" alt="">            
                </div>
            </div>
        </div>
    </div>

@endsection
