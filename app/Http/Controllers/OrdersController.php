<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class OrdersController extends Controller
{
    //購入履歴表示
    public function getOrderHistory(){
      $products = DB::table('products')
                  ->select('orders.user_id', 'orders.product_id', 'orders.order_price', 'orders.order_quantity', 'orders.created_at as date', 'products.*')
                  ->join('orders', 'products.id', '=', 'orders.product_id')
                  ->where('orders.user_id', '=', Auth::id())
                  ->orderby('date', 'desk')
                  ->get();

      return view('shop.order', ['products' => $products]);
    }

    //日付検索
    public function changeDate($tar_date = null){
      $products = DB::table('products')
                  ->select('orders.user_id', 'orders.product_id', 'orders.order_price', 'orders.order_quantity', 'orders.created_at as date', 'products.*')
                  ->join('orders', 'products.id', '=', 'orders.product_id')
                  ->where('orders.user_id', '=', Auth::id())
                  ->orderby('date', 'desk')
                  ->where('products.updated_at', 'like', $tar_date .'%')
                  ->get();


      return view('shop.order', ['products' => $products]);
    }

    public function getDateList(){
      //6カ月前までの日付を取得
      //日付は月の最初の日付で計算
        $start_date = date('Y-m-01', time());
        $ux_start_date = strtotime($start_date);
        $end_date = date('Y-m-01', strtotime($start_date . "-1 year"));
        $ux_end_date = strtotime($end_date);
        $date_list = [];

        for($date = $ux_start_date; $date >= $ux_end_date; $date = strtotime('-1 month', $date)){
          $date_list[] = date('Y-m', $date);
        }

        //ヘッダーの設定
        header('Content-type:application/json; charset=utf8');
        //json_encodeして出力
        echo json_encode($date_list);
    }


}
