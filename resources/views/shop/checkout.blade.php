@extends('layouts.layout')
@section('title')
@endsection
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h3>合計金額：{{ number_format(Session::get('cart')-> total_price) }}円</h3>
    </div>
  </div>
</div>
@endsection
