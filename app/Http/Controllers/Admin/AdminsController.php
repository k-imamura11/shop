<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class AdminsController extends Controller
{
    public function __construct(){
      $this-> middleware('auth:admin');
    }

    public function getIndex(){
      return view('admin.index');
    }
}
