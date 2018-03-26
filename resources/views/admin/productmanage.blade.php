@extends('layouts.layout_admin')
@section('title')
@endsection
@section('content')
<div class="container">
  @if(Session::has('message'))
  <div class="alert alert-danger">{{ Session::get('message') }}</div>
  @endif
  @if(Session::has('success_message'))
  <div class="alert alert-success">{{ Session::get('success_message') }}</div>
  @endif
  <form method="post" action='/admin/add-product' enctype="multipart/form-data">
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
          <label for="image">写真1 アップロード</label>
          <input class="btn btn-default form" type="file" name="image_url_1">
          <div class="thumbnail">
            <img data-src="holder.js/200x200/gray">
          </div>
        </div>
        <div class="form-group clearfix">
          <label for="image">写真2 アップロード</label>
          <input class="btn btn-default form" type="file" accept=".jpg,.gif,.png,image/gif,image/jpeg,image/png" name="image_url_2">
          <div href="" class="thumbnail">
            <img data-src="holder.js/200x200/gray">
          </div>
        </div>
        <div class="form-group clearfix">
          <label for="image">写真3 アップロード</label>
          <input class="btn btn-default form" type="file" accept=".jpg,.gif,.png,image/gif,image/jpeg,image/png" name="image_url_3">
          <div class="thumbnail">
            <img data-src="holder.js/200x200/gray">
          </div>
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
    {{ csrf_field() }}
  </form>
  <br>
</div>
<script>
(function(){
  $('.form').on('change', function(e){
    var file = e.target.files[0];
    //FileReaderのインスタンス
    var reader = new FileReader();
    var preview = e.target.nextElementSibling.firstElementChild;
    //fileのurlを読み込む
    reader.readAsDataURL(file);
    //MIMEタイプチェック
    if(file.type !== 'image/jpeg' && file.type !== 'image/png' && file.type !== 'image/gif'){
      alert('拡張子はjpeg,png,gifのみ有効です。');
      return false;
    }
    //ファイルサイズチェック(2MBまで)
    if(file.size > 2000000){
      alert('ファイルサイズが2MBを超えています。2MB以下のファイルを指定してください。')
      return false;
    }
    reader.addEventListener('load', function(){
      preview.src = reader.result;
    });
  });
})();
</script>
@endsection
