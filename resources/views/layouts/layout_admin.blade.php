<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <!-- ToDoタイトル決める -->
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('/css/flat-ui.min.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('/css/app_admin.css?') . date('F d Y H:i:s.', filemtime('css/app_admin.css')) }}">
    <script type="text/javascript" src="{{ asset('/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/holder.js') }}"></script>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="header">
            <nav class="navbar navbar-default navbar-fixed-top">
              <div class="container-fluid">
                <div class="col-md-1 col-xs-2">
                  <div class="navbar-header">
                    <a class="navbar-brand" href="{{ route('admin.index') }}">SHOP</a>
                  </div>
                </div>
                <div class="col-md-3">
                  <ul class="nav navbar-nav navbar-left admin_name hidden-xs">
                      <li>ようこそ</li>
                      <li class="name_color">{{ Auth::user()-> name }}</li>
                      <li>さん</li>
                  </ul>
                </div>
                <div class="col-md-8 col-md-offset-0 col-xs-1 col-xs-offset-9">
                  <ul class="nav navbar-nav navbar-right">
                    <li class="hidden-xs"><a href="{{ route('admin.userlist') }}">ユーザー一覧</a></li>
                    <li class="hidden-xs"><a href="{{ route('admin.adminlist') }}">管理者一覧</a></li>
                    <li class="hidden-xs"><a href="{{ route('admin.productlist') }}">商品一覧</a></li>
                    <li class="hidden-xs"><a href="{{ route('admin.productmanage') }}">商品管理</a></li>
                    <li class="hidden-xs"><a href="">更新履歴</a></li>
                    <li class="hidden-xs"><a href="{{ route('admin.logout') }}">ログアウト</a></li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"   aria-expanded="false">
                        <i class="glyphicon glyphicon-list" style="font-size: 20px;"></i>
                      </a>
                      <ul class="dropdown-menu">
                        <li><a href="{{ route('admin.userlist') }}">ユーザー一覧</a></li>
                        <li><a href="{{ route('admin.adminlist') }}">管理者一覧</a></li>
                        <li><a href="{{ route('admin.productlist') }}">商品一覧</a></li>
                        <li><a href="{{ route('admin.productmanage') }}">商品管理</a></li>
                        <li><a href="#">更新履歴</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('admin.logout') }}">ログアウト</a></li>
                      </ul>
                    </li>
                  </ul>
                </div>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </div>
    <div class="content">
      @yield('content')
    </div>
    <div class="footer">
    </div>
  </body>
</html>
