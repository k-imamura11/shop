@extends('layouts.layout')
@section('title')
@endsection
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-3">
      <div class="panel panel-default">
        <div class="panel-heading">商品カテゴリー</div>
          <ul class="nav nav-pills nav-stacked">
            <li><a href="{{ route('shop.index') }}"><i class="glyphicon glyphicon-star"></i> 全て</a></li>
            <li><a href="{{ route('shop.genre-change', ['id' => 1]) }}"><i class="glyphicon glyphicon-star"></i> メンズファッション</a></li>
            <li><a href="{{ route('shop.genre-change', ['id' => 2]) }}"><i class="glyphicon glyphicon-star"></i>レディースファッション</a></li>
            <li><a href="{{ route('shop.genre-change', ['id' => 3]) }}"><i class="glyphicon glyphicon-star"></i>キッズ・ベビー</a></li>
            <li><a href="{{ route('shop.genre-change', ['id' => 4]) }}"><i class="glyphicon glyphicon-star"></i>時計・アクセサリー</a></li>
          </ul>
      </div>
    </div>

    <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-heading">{{ $genre }}</div>
        <div class="row">
          <div class="col-md-12">


          @if($products)
          @foreach($products as $data)
          <div class="col-md-4">
            <div class="thumbnail">
              <a href="{{ route('shop.add-history', ['id' => $data-> id]) }}">
                <img class="image" src="{{ asset('/images/'.$data-> image_url_1) }}"></img>
              </a>
              <div class="caption clearfix">
                <div class="title title{{ $data-> id }}">{{ $data-> title }}</div>
                <div class="quantity">在庫: {{ $data-> quantity }}個</div>
                <div class="price">{{ number_format($data-> price) }}円</div>
                <div><a href="{{ route('shop.add-history', ['id' => $data-> id]) }}" class="btn btn-default btn-detail" role="button">商品詳細</a></div>
                <div><a href="{{ route('shop.add-cart', ['id' => $data-> id]) }}" class="btn btn-default btn-cart glyphicon glyphicon-shopping-cart" role="button"></a></div>
              </div>
            </div>
          </div>
          @endforeach
          @else
          <h3>商品がありません</h3>
          @endif
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
<div class="paginate">{{ $products->links() }}</div>
<script>
(function(){
$(document).ready(function(){
  var $counts = {{ $data-> id }};
  for(var $i = 0; $i <= $counts; $i++){
    if($('.title' + $i).text().length > 36){
      $('.title' + $i).css({
        "font-size": "13px"
      });
    }
  }
});
})();
</script>
@endsection
