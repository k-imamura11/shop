<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use DB;
use Session;

class ProductsController extends Controller
{

  public function getIndex(){
    $products = DB::table('products')
                    ->where('hideflag', '=',  0)
                    ->orderby('updated_at', 'desc')
                    ->paginate(9);

    //$gere初期化
    $genre = '商品一覧';

    return view('shop.index', ['products' => $products, 'genre' => $genre]);
  }

  public function getProductDetail($id){
    $products = Product::find($id);
    return view('shop.detail', ['product' => $products]);
  }

  public function getGenreChange($id){
    $products = DB::table('products')
                    ->where('genre', '=', $id)
                    ->where('hideflag', '=', 0)
                    ->paginate(9);

    //$genreにカテゴリを紐づけ
    switch($id){
      case(1):
        $genre = 'メンズファッション';
      break;
      case(2):
        $genre = 'レディースファッション';
      break;
      case(3):
        $genre = 'キッズ・ベビー';
      break;
      case(4):
        $genre = '時計・アクセサリー';
      break;
    }

    return view('shop.index', ['products' => $products, 'genre' => $genre]);
  }

  public function getHistory(){
    if(!Session::has('product')){
      return redirect()-> route('shop.history');
    }
    $history = Session::has('product') ? Session::get('product') : null;
    $products = new Product($history);

    return view('shop.history', ['products' => $products-> items]);

  }

  public function getAddHistory(Request $request, $id){
    $product = Product::find($id);
    $history = Session::has('product') ? Session::get('product') : null ;
    $items = new Product($history);
    $items-> addHistory($product, $product-> id);

    $request-> session()-> put('product', $items);

    // dd(Session::get('product'));
    $url = url('shop/detail' .'/' .$id);

    return redirect($url);
  }


}
