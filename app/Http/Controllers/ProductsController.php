<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use DB;
use Session;
use Stripe\Charge;
use Stripe\Stripe;

class ProductsController extends Controller
{

  //商品一覧表示
  public function getIndex(Request $request){
    $products = DB::table('products')
                    ->where('hideflag', '=',  0)
                    ->orderby('updated_at', 'desc')
                    ->paginate(9);

    //$gere初期化
    $genre = '商品一覧';

    return view('shop.index', ['products' => $products, 'genre' => $genre]);
  }

  //商品詳細表示
  public function getProductDetail($id){
    $products = Product::find($id);
    return view('shop.detail', ['product' => $products]);
  }

  //カテゴリソート
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

  //閲覧履歴画面表示
  public function getHistory(){
    if(!Session::has('product')){
      return view('shop.history');
    }
    $history = Session::has('product') ? Session::get('product') : null;
    $products = new Product($history);

    //UNIXタイムで降順にする
    foreach ($products-> items as $key => $value) {
      $sort[$key] = $value['date_time'];
    }
    array_multisort($sort, SORT_DESC, $products-> items);

    return view('shop.history', ['products' => $products-> items]);

  }

  //閲覧履歴追加
  public function getAddHistory(Request $request, $id){
    $product = Product::find($id);
    $history = Session::has('product') ? Session::get('product') : null ;
    $items = new Product($history);
    $items-> addHistory($product, $product-> id);

    $request-> session()-> put('product', $items);
    $url = url('shop/detail' .'/' .$id);

    return redirect($url);
  }

  //決済ページ表示
  public function getCheckout(){
    if(!Session::has('cart')){
      Session::flash('message', 'カート内にアイテムが無いため決済ページを表示できません。');
      return redirect()-> route('shop.cart');
    }
    $oldCart = Session::has('cart') ? Session::get('cart') : null;
    $cart = new Cart($oldCart);
    $total_price = $cart-> total_price;
    return view('shop.checkout', ['total_price' => $total_price]);
  }

  //決済処理
  public function postCheckout(Request $request){
    if(!Session::has('cart')){
      return view('shop.cart');
    }
    $oldCart = Session::has('cart') ? Session::get('cart') : null;
    $cart = new Cart($oldCart);
    $products = $cart-> items;

    Stripe::setApiKey('sk_test_lpzBO5ZgdS0HLIPUc0N8NJfe');

    DB::beginTransaction();
    try {
      Charge::create([
        "amount" => $cart-> total_price,
        "currency" => "jpy",
        "source" => $request-> input('stripeToken'),
        "description" => "test"
      ]);
    } catch(\Exception $e) {
      return redirect()-> route('checkout')-> with('error', $e-> getMessage());
      DB::rollback();
    }

    //購入後処理
    $this-> takeQuantity($products);
    $this-> addHideFlag();

    DB::commit();
    Session::forget('cart');

    return view('shop.result', ['products' => $products]);
  }

  //在庫減らす
  public function takeQuantity($items){
    foreach($items as $item){
      if ($item['item']-> quantity > 0){
        Product::where('id', $item['item']-> id)
                ->decrement('quantity', $item['quantity']);
      }
    }
  }

  //商品非表示処理
  public function addHideFlag(){
    $items = Product::all();

    foreach($items as $item){
      if($item-> quantity <= 0){
        Product::where('id', $item-> id)
                ->update(['hideflag' => 1]);
      }
    }
  }

}
