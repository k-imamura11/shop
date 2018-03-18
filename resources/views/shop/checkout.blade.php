@extends('layouts.layout')
@section('title')
@endsection
@section('content')
<div class="container">
  <div class="row">
    <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
      <h3>合計金額：{{ number_format($total_price) }}円</h3>

      <div id="charge-error" class="alert alert-danger {{ !Session::has('error') ? 'hidden' : '' }}">
        {{ Session::get('error') }}
      </div>

      <form action="" method="post" id="checkout-form">
        <div class="row">
          <div class="col-xs-12">
            <div class="form-group">
              <label for="name">名前</label>
              <input type="text" id="name" class="form-control" required>
            </div>
          </div>
          <div class="col-xs-12">
            <div class="form-group">
              <label for="address">住所</label>
              <input type="text" id="address" class="form-control" required>
            </div>
          </div>
          <div class="col-xs-12">
            <div class="form-group">
              <label for="card-name">カード名(名義)</label>
              <input type="text" id="card-name" class="form-control" required>
            </div>
          </div>
          <div class="col-xs-12">
            <div class="form-group">
              <label for="card-number">カード番号</label>
              <input type="text" id="card-number" class="form-control" required>
            </div>
          </div>
          <div class="col-xs-6">
            <div class="form-group">
              <label for="card-expiry-month">有効期限(月)</label>
              <input type="text" id="card-expiry-month" class="form-control" required>
            </div>
          </div>
          <div class="col-xs-6">
            <div class="form-group">
              <label for="card-expiry-year">有効期限(年)</label>
              <input type="text" id="card-expiry-year" class="form-control" required>
            </div>
          </div>
          <div class="col-xs-12">
            <div class="form-group">
              <label for="card-cvc">セキュリティコード</label>
              <input type="text" id="card-cvc" class="form-control" required>
            </div>
          </div>
        </div>
        {{ csrf_field() }}
        <button type="submit" class="btn btn-success pull-right">決済</button>
      </form>
      <br>
      <br>
    </div>
  </div>
</div>
<script src="https://js.stripe.com/v2/"></script>
<script type="text/javascript" src="{{ asset('/js/checkout.js?') . date('F d Y H:i:s.', filemtime('css/app.css')) }}"></script>
@endsection
