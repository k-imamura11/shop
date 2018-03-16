<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class UserManagementsController extends Controller
{
    //一般ユーザー取得
    public function getUserList(){
      $users = DB::table('users')
                  -> orderby('id', 'asc')
                  -> get();

      return view('admin.userlist', ['users' => $users]);
    }

    //管理ユーザー取得
    public function getAdminList(){
      $admins = DB::table('admins')
                  -> orderby('id', 'asc')
                  -> get();

      return view('admin.adminlist', ['admins' => $admins]);
    }
}
