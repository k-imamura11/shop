@extends('layouts.layout_admin')
@section('title')
@endsection
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <table class="product-table" border="2px">
        <h4>商品一覧</h4>
        <tr class="table-title">
          <th class="col1"><div class="id">商品ID</div></th>
          <th class="col2"><div class="title">商品名/タイトル</div></th>
          <th class="col3"><div class="price">価格(単価)</div></th>
          <th class="col4"><div class="quantity">在庫</div></th>
          <th class="col5"><div class="quantity">表示状況</div></th>
        </tr>
        @foreach($products as $data)
        <tr class="table-data">
          <td><a href="" class="glyphicon glyphicon-check pull-left" style="font-size: 18px; margin: 5px;"></a><div>{{ $data-> id }}</div></td>
          <td><div>{{{ $data-> title }}}</div></td>
          <td><div>{{ number_format($data-> price) }}</div></td>
          <td><div>{{ $data-> quantity }}</div></td>
          @if($data-> hideflag == 0)
          <td><div style="color: #0406f1">表示中</div></td>
          @elseif($data-> hideflag == 1)
          <td><div style="color: #ec3200">非表示</div></td>
          @endif
        </tr>
        @endforeach
      </table>
      <br>
      <div class="paginate">{{ $products-> links() }}</div>
      <br>
    </div>
  </div>
</div>
@endsection
