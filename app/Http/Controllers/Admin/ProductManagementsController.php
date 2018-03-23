<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductManagement;
use DB;

class ProductManagementsController extends Controller
{
    //商品一覧取得
    public function getProductList(){
      $products = DB::table('products')
                      ->orderby('created_at', 'desc')
                      ->paginate(50);


      return view('admin.productlist', ['products' => $products]);
    }
}
