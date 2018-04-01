<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
  
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
