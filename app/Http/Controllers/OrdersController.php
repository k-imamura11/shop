<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class OrdersController extends Controller
{
    //購入履歴表示
    public function getOrderHistory(){
      $products = DB::table('orders')
                  ->join('users', 'orders.user_id', '=', 'users.id')
                  ->join('products', 'orders.product_id', '=', 'products.id')
                  ->where('orders.user_id', '=', Auth::id())
                  ->orderby('orders.updated_at', 'desk')
                  ->get();

      return view('shop.order', ['products' => $products]);
    }
}
