<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('/css/flat-ui.min.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('/css/app_admin.css?') . date('F d Y H:i:s.', filemtime('css/app.css')) }}">
    <script type="text/javascript" src="{{ asset('/js/jquery.min.js') }}"></script>
  </head>
  <body>
    <div id="admin">
      <div class="container">
          <div class="row">
              <div class="col-md-8 col-md-offset-2">
                  <div class="panel panel-default">
                      <div class="panel-heading">管理者ログイン</div>

                      <div class="panel-body">
                          <form class="form-horizontal" method="POST" action="{{ route('admin.login') }}">
                              {{ csrf_field() }}

                              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                  <label for="email" class="col-md-4 control-label">メールアドレス</label>

                                  <div class="col-md-6">
                                      <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                      @if ($errors->has('email'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('email') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>

                              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                  <label for="password" class="col-md-4 control-label">パスワード</label>

                                  <div class="col-md-6">
                                      <input id="password" type="password" class="form-control" name="password" required>

                                      @if ($errors->has('password'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('password') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>
                              <div class="form-group">
                                  <div class="col-md-8 col-md-offset-4">
                                      <button type="submit" class="btn btn-primary">
                                          ログイン
                                      </button>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
  </body>
</html>
