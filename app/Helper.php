<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Helper extends Model
{
    //日付をY年M月D日 H時I分S秒形式にフォーマット
    public function date_format($date){
      date('Y年M月D日 H時I分S秒', strtotime($date));
    }
}
