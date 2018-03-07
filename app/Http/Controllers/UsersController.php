<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class UsersController extends Controller
{

  public function getLogout(){
    Auth::logout();
    return redirect()-> back();
  }

}
