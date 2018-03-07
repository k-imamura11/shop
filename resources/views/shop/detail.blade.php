@extends('layouts.layout')
@section('title')
@endsection
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-4">
      <div class="detail-thumbnail">
        <div class="thumbnail-main">
          <img class="main" src="{{ asset('/images/'. $product-> image_url_1) }}"></img>
        </div>
        <div class="thumbnail-sub">
          @if($product-> image_url_1)
          <img class="sub" data_url="{{ asset('/images/'. $product-> image_url_1) }}" src="{{ asset('/images/'. $product-> image_url_1) }}"></img>
          @endif
          @if($product-> image_url_2)
          <img class="sub" data_url="{{ asset('/images/'. $product-> image_url_2) }}" src="{{ asset('/images/'. $product-> image_url_2) }}"></img>
          @endif
          @if($product-> image_url_3)
          <img class="sub" data_url="{{ asset('/images/'. $product-> image_url_3) }}" src="{{ asset('/images/'. $product-> image_url_3) }}"></img>
          @endif
        </div>
      </div>
    </div>

    <div class="col-md-8">
      <div class="panel panel-default">
        <div class="detail-content clearfix">
          <h3 class="title">{{ $product-> title }}</h3>
          <p>商品説明：</p>
          <div class="discription">{!! nl2br($product-> discription) !!}</div>
          <p>備考：</p>
          <div class="detail">{!! nl2br($product-> detail) !!}</div>
          <div class="quantity">在庫：{{ $product-> quantity }}</div>
          <div class="price">{{ number_format($product-> price) }}円</div>
          <a href="{{ route('shop.add-cart', ['id' => $product-> id]) }}" class="btn btn-lg btn-primary glyphicon glyphicon-shopping-cart pull-right">カートへ</a>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
(function(){
  $('.sub').on('click', function(){
    var $dataUrl = $(this).attr('data_url');
    $('.main').attr('src', $dataUrl);
  });
})();
</script>
@endsection
