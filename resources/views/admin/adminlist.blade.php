@extends('layouts.layout_admin')
@section('title')
@endsection
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <table class="user-table" border="2px">
        <h4>管理者一覧</h4>
        <tr class="table-title">
          <th class="col1"><div class="id">ユーザーid</div></th>
          <th class="col2"><div class="name">ユーザー名</div></th>
          <th class="col3"><div class="email">メールアドレス</div></th>
          <th class="col4"><div class="address">住所</div></th>
        </tr>
        @foreach($admins as $admin)
        <tr class="table-data">
          <td><a href="" class="glyphicon glyphicon-check pull-left" style="font-size: 18px; margin: 5px;"></a><div>{{ $admin-> id }}</div></td>
          <td><div>{{ $admin-> name }}</div></td>
          <td><div>{{ $admin-> email }}</div></td>
          <td><div>{{ $admin-> address }}</div></td>
        </tr>
        @endforeach
      </table>
      <br>
      <div class="paginate">{{ $admins-> links() }}</div>
      <br>
    </div>
  </div>
</div>
@endsection
