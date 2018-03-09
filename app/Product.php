<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $fillable = [
      'title', 'quantity','discription', 'detail', 'price', 'genre', 'image_url_1', 'image_url_2', 'image_url_3', 'hideflag',
  ];

  public $items;

  public function __construct($history = null){
    if($history){
      $this-> items = $history-> items;
    }
  }

  public function addHistory($item, $id){
    $checked_item = ['item' => $item, 'date_time' => ''];

    $checked_item['date_time'] = time();
    $this-> items[$id] = $checked_item;
  }

}
