<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  protected $fillable = [
      'user_id', 'product_id', 'order_price', 'order_quantity',
  ];

}
