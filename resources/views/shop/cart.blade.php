@extends('layouts.layout')
@section('title')
@endsection
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-3">
      <div class="panel panel-default">
        <div class="panel-heading">カテゴリ</div>
          <ul class="nav nav-pills nav-stacked">
            <li><a href="{{ route('shop.index') }}"><i class="glyphicon glyphicon-chevron-right pull-right"></i> 全て</a></li>
            <li><a href="{{ route('shop.genre-change', ['id' => 1]) }}"><i class="glyphicon glyphicon-chevron-right pull-right"></i> メンズファッション</a></li>
            <li><a href="{{ route('shop.genre-change', ['id' => 2]) }}"><i class="glyphicon glyphicon-chevron-right pull-right"></i>レディースファッション</a></li>
            <li><a href="{{ route('shop.genre-change', ['id' => 3]) }}"><i class="glyphicon glyphicon-chevron-right pull-right"></i>キッズ・ベビー</a></li>
            <li><a href="{{ route('shop.genre-change', ['id' => 4]) }}"><i class="glyphicon glyphicon-chevron-right pull-right"></i>時計・アクセサリー</a></li>
          </ul>
      </div>
    </div>

    <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-heading">カートの中身</div>
        <div class="row">
          <div class="col-md-12">


          @if(Session::has('cart'))
          @foreach($products as $data)
          <div class="col-md-4">
            <div class="thumbnail">
              <a href="">
                <img class="image" src=""></img>
              </a>
              <div class="caption clearfix">
                <a href="{{ route('shop.detail', ['id' => $data['item']-> id]) }}">
                  <img class="image" src="{{ asset('/images/'.$data['item']-> image_url_1) }}"></img>
                </a>
                <div class="title title{{ $data['item']-> id }}">{{ $data['item']-> title }}</div>
                <div class="quantity">数量：{{ $data['quantity'] }}個</div>
                <div class="price">{{ number_format($data['price']) }}円</div>
                <div><a href="{{ route('shop.add-history', ['id' => $data['item']-> id]) }}" class="btn btn-default btn-detail" role="button">商品詳細</a></div>
                <div><a href="{{ route('shop.delete-item', ['id' => $data['item']-> id]) }}" class="btn btn-default glyphicon glyphicon-trash  btn-trash" role="button"></a></div>
              </div>
            </div>
          </div>
          @endforeach
          @else
          <h3 class="empty">カートの中身が空です。</h3>
          @endif
          </div>
        </div>
      </div>
      <a href="{{ route('shop.cart-flash') }}" class="btn btn-primary btn-lg" role="button">カートを空にする</a>
      <a href="{{ route('shop.checkout') }}" class="btn btn-primary btn-lg check-out" role="button">決済</a>
      @if(Session::has('cart'))
      <div class="total-price">合計金額：{{ number_format(Session::get('cart')-> total_price) }}円</div>
      @endif
      <br>
      <br>
    </div>
  </div>
</div>
<script>
(function(){
  $(document).ready(function(){
    //暫定対応ToDo
    @if(Session::has('cart'))
    var $counts = {{ $data['item']-> id }};
    for(var $i = 0; $i <= $counts; $i++){
      if($('.title' + $i).text().length > 36){
        $('.title' + $i).css({
          "font-size": "13px"
        });
      }
    }
  });
  @endif
})();
</script>
@endsection
