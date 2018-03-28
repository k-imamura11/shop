@extends('layouts.layout_admin')
@section('title')
@endsection
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-xs-12 col-md-offset-2">
      <form action="" method="post" id="userdetail-form">
        <div class="row">
          <div class="col-xs-12">
            <div cllass="form-group">
              <label>名前</label>
              <input type="text" name="name" class="form-control" value="{{ $user-> name }}">
            </div>
          </div>
          <div class="col-xs-12">
            <div cllass="form-group">
              <label>メールアドレス</label>
              <input type="text" name="email" class="form-control" value="{{ $user-> email }}">
            </div>
          </div>
          <div class="col-xs-12">
            <div cllass="form-group">
              <label>電話番号</label>
              <input type="text" name="phone_number" class="form-control" value="{{ !empty($user-> phone_number) ? $user-> phone_number : '' }}">
            </div>
          </div>
          <div class="col-xs-12">
            <div cllass="form-group">
              <label>郵便番号</label>
              <input type="text" name="address_number" class="form-control" value="{{ !empty($user-> address_number) ? $user-> address_number : '' }}">
            </div>
          </div>
          <div class="col-xs-12">
            <div cllass="form-group">
              <label>住所</label>
              <input type="text" name="address" class="form-control" value="{{ $user-> address }}">
            </div>
          </div>
          <div class="col-xs-12">
            <div cllass="form-group">
              <label>生年月日(yyyymmdd)</label>
              <input type="text" name="born" class="form-control" value="{{ !empty($user-> born) ? $user-> born : '' }}">
            </div>
          </div>
          <div class="col-xs-12">
            <div cllass="form-group">
              <label>新しいパスワード</label>
              <input type="text" name="password" class="form-control" value="">
            </div>
          </div>
        </div>
        <br>
        <button type="submit" class="btn btn-primary pull-right">保存</button>
      </form>
    </div>
  </div>
</div>
@endsection
