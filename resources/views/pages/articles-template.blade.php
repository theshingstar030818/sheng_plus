<div class="row">
    @foreach ($articles as $article)
    <div class="col-sm-12 col-md-4 article">
        <div class="article-header">
            <span class="tag">金屬</span>
            <span class="published-date">{{formatDate($article->published_date)}}</span>
            <span class="article-cate">{{$article->name}}</span>
        </div>
        <h3 class="article-title">
            {{$article->title}}
        </h3>
        <div class="article-content">
            {{substr($article->content, 0, 200)}}
        </div>
        <div class="article-img">
            <a href="{{url('/article/'.$article->id)}}">
                <img src="{{getFullImageAddressFromAttachmentId($article->img)}}" alt="">            
            </a>
        </div>
    </div>
    @endforeach
</div>
