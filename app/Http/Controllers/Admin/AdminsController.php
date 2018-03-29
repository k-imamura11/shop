<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Admin;
use DB;
use Session;

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

      return view('admin.userdetail', ['user' => $user]);
    }

    public function getAdmindetail($id){
      $admin = Admin::find($id);

      return view('admin.admindetail', ['admin' => $admin]);
    }


    // public function getUserForm(){
    //   return redirect()-> route('admin.userdetail');
    // }
    //
    // public function postUserForm(){
    //
    // }

    public function getAdminForm(){
      return redirect()-> route('admin.userdetail');
    }

    public function postAdminForm(Request $request, $id){
      $admin = new Admin;
      $admin-> validator($request->all());

      $name = $request-> name;
      $email = $request-> email;
      $address = $request-> address;
      $phone_number = $request-> phone_number;
      $address_number = $request-> address_number;
      $born = $request-> born;
      // $password = $request-> password;

      Admin::where('id', $id)-> update([
        'name' => $name,
        'email' => $email,
        'address' => $address,
        'phone_number' => $phone_number,
        'address_number' => $address_number,
        'born' => $born,
        // 'password' => $password,
      ]);

      Session::flash('success_message', '管理者情報を更新しました。');
      $url = url('admin/admindetail/' .$id);
      return redirect($url);

    }
}
