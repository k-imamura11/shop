<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

  public $items;
  public $total_quantity = 0;
  public $total_price = 0;

  public function __construct($oldCart){
    if($oldCart){
      $this-> items = $oldCart-> items;
      $this-> total_quantity = $oldCart-> total_quantity;
      $this-> total_price = $oldCart-> total_price;
    }
  }

  //カートにアイテム追加
  public function addCart($item, $id){
    $stored_item = ['item' => $item, 'quantity' => 0, 'price' => $item-> price ];

    //アイテム追加購入処理
    if($this-> items){
      if(array_key_exists($id, $this-> items)){
        ////配列の中にすでに同じidがある場合はitemにidを再セット
        $stored_item = $this-> items[$id];
      }
    }

    $stored_item['quantity']++;
    $stored_item['price'] =  $item-> price * $stored_item['quantity'];
    $this-> items[$id] = $stored_item;
    $this-> total_quantity++;
    $this-> total_price += $item-> price;
  }

  //カートのアイテム削除(１つ)
  public function deleteItem($item, $id){

    $this-> items[$id]['quantity']--;
    $this-> items[$id]['price'] -= $item-> price;
    $this-> total_quantity--;
    $this-> total_price -= $item-> price;

    if($this-> items[$id]['quantity'] <= 0){
      unset($this-> items[$id]);
    }
  }

}
