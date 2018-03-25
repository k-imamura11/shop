@extends('layouts.layout_admin')
@section('title')
@endsection
@section('content')
<div class="container">
  <form method="post">
    <div class="row">
      <div class="col-md-8">
        <div class="row">
          <div class="col-xs-12">
            <div class="form-group">
              <label for="title">商品名</label>
              <input type="text" name="title" class="form-control">
            </div>
          </div>
          <div class="col-xs-12">
            <div class="form-group">
              <label for="genre">ジャンル</label>
              <select name="genre" class="form-control">
                <option>メンズファッション</option>
                <option>レディースファッション</option>
                <option>キッズ・ベビー</option>
                <option>時計・アクセサリー</option>
              </select>
            </div>
          </div>
          <div class="col-xs-6">
            <div class="form-group">
              <label for="quantity">数量</label>
              <input type="text" name="quantity" class="form-control">
            </div>
          </div>
          <div class="col-xs-6">
            <div class="form-group">
              <label for="price">価格</label>
              <input type="text" name="price" class="form-control">
            </div>
          </div>
          <div class="col-xs-12">
            <div class="form-group">
              <label for="detail">商品詳細</label>
              <textarea name="detail" cols="100" rows="15" class="form-control"></textarea>
            </div>
          </div>
          <div class="col-xs-12">
            <div class="form-group">
              <label for="discription">商品説明</label>
              <textarea name="discription" cols="100" rows="15" class="form-control"></textarea>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group clearfix">
          <label>写真１</label>
          <a href="" class="thumbnail">
            <img class="form-control preview" data-src="holder.js/200x200/gray">
    		  </a>
          <label for="image">写真1 アップロード</label>
          <input class="btn btn-default form" type="file" name="image_url_1">
        </div>
        <div class="form-group clearfix">
          <label>写真２</label>
          <a href="" class="thumbnail">
            <img class="form-control preview" name="image_url_2" data-src="holder.js/200x200/gray">
    		  </a>
          <label for="image">写真2 アップロード</label>
          <input class="btn btn-default form" type="file" name="image_url_2">
        </div>
        <div class="form-group clearfix">
          <label>写真３</label>
          <a href="" class="thumbnail">
    			  <img class="form-control preview" name="image_url_3" data-src="holder.js/200x200/gray">
    		  </a>
          <label for="image">写真3 アップロード</label>
          <input class="btn btn-default form" type="file" name="image_url_3">
        </div>
      </div>
    </div>
    <br>
    <br>
    <div class="row">
      <div class="col-xs-12">
        <button role="button" class="btn btn-success" style="width: 100%">登録</button>
      </div>
    </div>
  </form>
  <br>
</div>
<script>
(function(){
  $('.form').on('change', function(e){
    var file = e.target.files[0];
    //FileReaderのインスタンス
    var reader = new FileReader();
    var preview = $('.preview');
    //fileのurlを読み込む
    reader.readAsDataURL(file);

    reader.addEventListener('load', function(){
      preview.attr('src', reader.result);
    });
  });
})();
</script>
@endsection
