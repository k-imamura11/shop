@extends('layouts.layout')
@section('title')
@endsection
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">

      <div id="date-list" class="dropdown">
        <button class="btn btn-default dropdown-toggle pull-right" type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
          {{ date('Y-m', time()) }}
          <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu">
          @foreach($date_list as $date)
          <li><a href="{{ route('order.change-date', ['tar_date' => $date]) }}">{{ $date }}</a></li>
          @endforeach
        </ul>
      </div>

      <div class="panel panel-default">
        <div class="panel-heading">購入履歴</div>
        <div class="row">
          <div class="col-md-12">
            @if($products)
            @foreach($products as $data)
            <div class="col-md-3">
              <div class="panel panel-default">
                <div class="panel-heading">購入日：{{ $data-> date }}</div>

              <div class="thumbnail">
                <a href="{{ route('shop.add-history', ['id' => $data-> id]) }}">
                  <img class="image" src="{{ asset('/images/' .$data-> image_url_1) }}"></img>
                </a>
                <div class="caption clearfix">
                  <div class="title title{{ $data-> id }}">{{ $data-> title }}</div>
                  <div class="quantity">購入数：{{ $data-> order_quantity }}個</div>
                  <div class="price">{{ number_format($data-> order_price) }}円</div>
                  <div><a href="{{ route('shop.add-history', ['id' => $data-> id]) }}" class="btn btn-default btn-detail" role="button">商品詳細</a></div>
                </div>
              </div>

            </div>

            </div>
          @endforeach
          @else
          <h3 class="empty">購入履歴がありません</h3>
          @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
(function(){

})();
</script>

@endsection
