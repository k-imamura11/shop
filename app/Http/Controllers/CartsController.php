<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Product;
use App\Cart;

class CartsController extends Controller
{
    //カート画面表示
    public function getCart(){
      if(!Session::has('cart')){
        return view('shop.cart');
      }
      $oldCart = Session::has('cart') ? Session::get('cart') : null;
      $cart = new Cart($oldCart);

      return view('shop.cart', [
        'products' => $cart-> items, 'total_price' => $cart-> total_price, 'total_quantity' => $cart-> total_quantity
      ]);
    }

    //カートにアイテム追加
    public function getAddCart(Request $request, $id){
      $product = Product::find($id);
      $oldCart = Session::has('cart') ? Session::get('cart') : null;
      $cart = new Cart($oldCart);
      $cart-> addCart($product, $product-> id);

      $request-> session()-> put('cart', $cart);
      // dd(Session::get('cart'));

      return redirect()-> back();
    }

    //カートアイテム削除(１つ)
    public function getDeleteItem(Request $request, $id){
      $product = Product::find($id);
      $oldCart = Session::has('cart') ? Session::get('cart') : null;
      $cart = new Cart($oldCart);
      $cart-> deleteItem($product, $product-> id);

      if($cart-> total_quantity <= 0){
        $request-> session()-> forget('cart');
      } else {
        $request-> session()-> put('cart', $cart);
      }

      return redirect()-> back();

    }


    //カートアイテム削除(全て)
    public function getCartFlash(Request $request){
      $request-> session()-> forget('cart');
      return redirect()-> back();
    }

}
