<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $fillable = [
      'title', 'quantity','description', 'detail', 'price', 'genre', 'image_url_1', 'image_url_2', 'image_url_3', 'hideflag',
  ];

}
