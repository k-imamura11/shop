<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <!-- ToDoタイトル決める -->
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('/css/flat-ui.min.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('/css/app_admin.css?') . date('F d Y H:i:s.', filemtime('css/app.css')) }}">
    <script type="text/javascript" src="{{ asset('/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/bootstrap.min.js') }}"></script>
  </head>
  <body>
    <div class="header">
      <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('admin.index') }}">SHOP</a>
          </div>
          <ul class="nav navbar-nav navbar-left admin_name">
            <li>ようこそ</li>
            <li class="name_color class="pull-right"">{{ Auth::user()-> name }}</li>
            <li class="pull-right">さん</li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="{{ route('admin.userlist') }}">ユーザー一覧</a></li>
            <li><a href="{{ route('admin.adminlist') }}">管理者一覧</a></li>
            <li><a href="#">商品一覧</a></li>
            <li><a class="" href="">商品管理</a></li>
            <li><a href="">更新履歴</a></li>
            <li><a href="{{ route('admin.logout') }}">ログアウト</a></li>
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
