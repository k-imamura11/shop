<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\User;
use App\Admin;
use Session;


class UserManagementsController extends Controller
{
    //一般ユーザー取得
    public function getUserList(){
      $users = DB::table('users')
                  -> orderby('id', 'asc')
                  -> paginate(50);

      return view('admin.userlist', ['users' => $users]);
    }

    //管理ユーザー取得
    public function getAdminList(){
      $admins = DB::table('admins')
                  -> orderby('id', 'asc')
                  -> paginate(50);

      return view('admin.adminlist', ['admins' => $admins]);
    }

    public function getUserdetail($id){
      $user = User::find($id);

      return view('admin.userdetail', ['user' => $user]);
    }

    public function getAdmindetail($id){
      $admin = Admin::find($id);

      return view('admin.admindetail', ['admin' => $admin]);
    }

    public function getUserForm($id){
      $url = url('admin/userdetail/' .$id);
      return redirect($url);
    }

    //一般ユーザー情報の更新
    public function postUserForm(Request $request, $id){
      $user = new User;
      $user-> validator($request-> all());

      $name = $request-> name;
      $email = $request-> email;
      $address = $request-> address;
      $phone_number = $request-> phone_number;
      $address_number = $request-> address_number;
      $born = $request-> born;
      $password = $request-> password;

      //passwordはフォームに入力されている場合のみupdateする
      $sql = ['name' => $name ,'email' => $email, 'address' => $address, 'phone_number' => $phone_number, 'address_number' => $address_number, 'born' => $born];
      if(!empty($password)){
        $sql = array_merge($sql, ['password' => bcrypt($password)]);
      }


      User::where('id', $id)-> update($sql);

      Session::flash('success_message', 'ユーザー情報を更新しました。');
      $url = url('admin/userdetail/' .$id);
      return redirect($url);
    }

    public function getAdminForm($id){
      $url = url('admin/admindetail/' .$id);
      return redirect($url);
    }

    //管理者情報の更新
    public function postAdminForm(Request $request, $id){
      $admin = new Admin;
      $admin-> validator($request->all());

      $name = $request-> name;
      $email = $request-> email;
      $address = $request-> address;
      $phone_number = $request-> phone_number;
      $address_number = $request-> address_number;
      $born = $request-> born;
      $password = $request-> password;

      //passwordはフォームに入力されている場合のみupdateする
      $sql = ['name' => $name ,'email' => $email, 'address' => $address, 'phone_number' => $phone_number, 'address_number' => $address_number, 'born' => $born];
      if(!empty($password)){
        $sql = array_merge($sql, ['password' => bcrypt($password)]);
      }


      Admin::where('id', $id)-> update($sql);

      Session::flash('success_message', '管理者情報を更新しました。');
      $url = url('admin/admindetail/' .$id);
      return redirect($url);
    }

}
