<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class OrdersController extends Controller
{
    //購入履歴表示
    public function getOrderHistory(){
      // $products = DB::table('products')
      $products = DB::table('products')
                  ->select('orders.user_id', 'orders.product_id', 'orders.order_price', 'orders.order_quantity', 'orders.created_at as date', 'products.*')
                  ->join('orders', 'products.id', '=', 'orders.product_id')
                  ->where('orders.user_id', '=', Auth::id())
                  ->orderby('date', 'desk')
                  ->get();

      return view('shop.order', ['products' => $products]);
    }

    //現在日付から12か月前まで取得する
    public function getDateList(){
      $start_date = date('Y-M', time());
      $end_date = date('Y-M', strtotime($start_date . '-1 year'));
      $date_list = [];

      for($date = $end_date; $date >= $start_date; $date = date('Y-M', strtotime($date . '+1 month'))){
        $date_list = date('Y-M', strtotime($date));
      }

      dd($date_list);
    }
}
