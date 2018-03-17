<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <!-- ToDoタイトル決める -->
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('/css/flat-ui.min.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('/css/app.css?') . date('F d Y H:i:s.', filemtime('css/app.css')) }}">
    <script type="text/javascript" src="{{ asset('/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/bootstrap.min.js') }}"></script>
  </head>
  <body>
    <div class="header">
      <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('shop.index') }}">SHOP</a>
          </div>

          <form class="navbar-form navbar-left">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="何をお探しですか？">
            </div>
            <button type="submit" class="btn btn-default">検索</button>
          </form>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="{{ route('shop.history') }}">閲覧履歴</a></li>
            <li><a href="#">購入履歴</a></li>
            <li><a class="glyphicon glyphicon-shopping-cart" href="{{ route('shop.cart') }}">カート<span class="badge">{{ Session::has('cart') ? Session::get('cart')-> total_quantity : '' }}</span></a></li>
            @if(Auth::check())
            <li><a href="{{ route('logout') }}">ログアウト</a></li>
            @else
            <li><a href="{{ route('register') }}">新規登録</a></li>
            <li><a href="{{ route('login') }}">ログイン</a></li>
            @endif
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="glyphicon glyphicon-list" style="font-size: 20px;"></i>
              </a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="#">Separated link</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </div>
    <div class="content">
      @yield('content')
    </div>
    <div class="footer">
    </div>
  </body>
</html>
