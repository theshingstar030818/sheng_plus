<div class="row">
    @foreach ($products as $product)
    <div class="col-sm-6 col-md-4 col-lg-2 product">
        <a href="{{url('/product/'.$product->id)}}">
            <img src="{{getFullImageAddressFromAttachmentId(json_decode($product->imgs)[0])}}" alt="">            
        </a>
        <div class="title">
            {{$product->name}}
        </div>
    </div>
    @endforeach
</div>
