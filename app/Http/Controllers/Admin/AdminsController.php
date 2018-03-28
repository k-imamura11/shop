<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Admin;
use DB;

class AdminsController extends Controller
{
    public function __construct(){
      $this-> middleware('auth:admin');
    }

    public function getIndex(){
      return view('admin.index');
    }

    public function getUserdetail($id){
      $user = User::find($id);
      // $user = DB::table('users')
      //            ->leftJoin('user_attributes', 'users.id', '=', 'user_attributes.user_id')
      //            ->where('users.id', '=', $id)
      //            ->get();

      return view('admin.userdetail', ['user' => $user]);
    }

    public function getAdmindetail($id){
      $admin = Admin::find($id);
      // $admin = DB::table('admin')
      //             ->leftJoin('admin_attributes', 'admins.id', '=', 'admin_attributes.user_id')
      //             ->where('admins.id', '=', $id)
      //             ->get();

      return view('admin.admindetail', ['admin' => $admin]);
    }
}
