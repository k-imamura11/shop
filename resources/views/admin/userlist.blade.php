@extends('layouts.layout_admin')
@section('title')
@endsection
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <table class="userstable" border="2px">
        <h4>ユーザー一覧</h4>
        <tr class="table-title">
          <th class="col1"><div class="id">ユーザーid</div></th>
          <th class="col2"><div class="name">ユーザー名</div></th>
          <th class="col3"><div class="email">メールアドレス</div></th>
          <th class="col4"><div class="address">住所</div></th>
        </tr>
        @foreach($users as $user)
        <tr class="table-data">
          <td><a href="" class="glyphicon glyphicon-check pull-left" style="font-size: 18px; margin: 5px;"></a><div>{{ $user-> id }}</div></td>
          <td><div>{{ $user-> name }}</div></td>
          <td><div>{{ $user-> email }}</div></td>
          <td><div>{{ $user-> address }}</div></td>
        </tr>
        @endforeach
      </table>
      <br>
      <br>
    <div>
  <div>
</div>
@endsection