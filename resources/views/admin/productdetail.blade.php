@extends('layouts.layout_admin')
@section('title')
@endsection
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-xs-12 col-md-offset-1">
      @if(Session::has('success_message'))
      <div class="alert alert-success">{{ Session::get('success_message') }}</div>
      @endif
      @if(Session::has('message'))
      <div class="alert alert-danger">{{ Session::get('message') }}</div>
      @endif
      @foreach($products as $data)
      <form action="{{ route('admin.productupdate', ['id' => $data-> id]) }}" method="post" id="productdetail-form" enctype="multipart/form-data">
        <div class="row">
          <div class="col-xs-4">
            <div class="form-group clearfix">
              <label for="image">写真1 アップロード</label>
              <input class="btn btn-default form" type="file" name="image_url_1" accept=".jpg,.gif,.png,image/gif,image/jpeg,image/png">
              <div class="thumbnail">
                <img src="{{ asset('images/' .$data-> image_url_1) }}">
              </div>
            </div>
          </div>
          <div class="col-xs-4">
            <div class="form-group clearfix">
              <label for="image">写真2 アップロード</label>
              <input class="btn btn-default form" type="file" accept=".jpg,.gif,.png,image/gif,image/jpeg,image/png" name="image_url_2">
              <div href="" class="thumbnail">
                <img src="{{ asset('images/' .$data-> image_url_2) }}">
              </div>
            </div>
          </div>
          <div class="col-xs-4">
            <div class="form-group clearfix">
              <label for="image">写真3 アップロード</label>
              <input class="btn btn-default form" type="file" accept=".jpg,.gif,.png,image/gif,image/jpeg,image/png" name="image_url_3">
              <div class="thumbnail">
                <img src="{{ asset('images/' .$data-> image_url_3) }}">
              </div>
            </div>
          </div>
          <div class="col-xs-12">
            <div cllass="form-group">
              <label>商品名</label>
              <input type="text" name="title" class="form-control" value="{{ $data-> title }}">
            </div>
          </div>
          <div class="col-xs-12">
            <div class="form-group">
              <label for="genre">ジャンル</label>
              <select name="genre" class="form-control">
                <option>{{ $data-> genre_name }}</option>
                <option>メンズファッション</option>
                <option>レディースファッション</option>
                <option>キッズ・ベビー</option>
                <option>時計・アクセサリー</option>
              </select>
            </div>
          </div>
          <div class="col-xs-12">
            <div cllass="form-group">
              <label>数量</label>
              <input type="text" name="quantity" class="form-control" value="{{ $data-> quantity }}">
            </div>
          </div>
          <div class="col-xs-12">
            <div cllass="form-group">
              <label>価格</label>
              <input type="text" name="price" class="form-control" value="{{ $data-> price }}">
            </div>
          </div>
          <div class="col-xs-12">
            <div cllass="form-group">
              <label>商品詳細</label>
              <textarea type="text" name="detail" class="form-control" cols="100" rows="15">
                @if(!empty($data-> detail))
                {{ $data-> detail }}
                @endif
              </textarea>
            </div>
          </div>
          <div class="col-xs-12">
            <div cllass="form-group">
              <label>商品説明</label>
              <textarea type="text" name="description" class="form-control" cols="100" rows="15">
                @if(!empty($data-> description))
                {{ $data-> description }}
                @endif
              </textarea>
            </div>
          </div>
        </div>
        <br>
        {{ csrf_field() }}
        <button type="submit" class="btn btn-primary pull-right">保存</button>
      </form>
      @endforeach
    </div>
  </div>
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
