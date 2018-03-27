@extends('layouts.layout')
@section('title')
@endsection
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">閲覧履歴</div>
        <div class="row">
          <div class="col-md-12">
            @if(Session::has('product'))
            @foreach($products as $data)
            <div class="col-md-3 col-xs-6">
              <div class="thumbnail">
                <a href="{{ route('shop.add-history', ['id' => $data['item']-> id]) }}">
                  <img class="image" src="{{ asset('/images/' .$data['item']-> image_url_1) }}"></img>
                </a>
                <div class="caption clearfix">
                  <div class="title title{{ $data['item']-> id }}">{{ $data['item']-> title }}</div>
                  <div class="price">{{ number_format($data['item']-> price) }}円</div>
                  <div><a href="{{ route('shop.add-history', ['id' => $data['item']-> id]) }}" class="btn btn-default btn-detail" role="button">商品詳細</a></div>
                  <div><a href="{{ route('shop.add-cart', ['id' => $data['item']-> id]) }}" class="btn btn-default btn-cart glyphicon glyphicon-shopping-cart" role="button"></a></div>
                </div>
              </div>
            </div>
          @endforeach
          @else
          <h3 class="empty">閲覧履歴がありません</h3>
          @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
(function(){
@if(Session::has('product'))
$(document).ready(function(){
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
