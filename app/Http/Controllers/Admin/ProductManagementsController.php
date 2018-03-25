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

    //商品管理ページ取得
    public function getProductManage(){
      return view('admin.productmanage');
    }

    //アップロードget
    public function getUpload(){
      return view('admin.productmanage');
    }

    //アップロードpost
    public function postUpload(){
        if(is_uploaded_file($_FILES['image']['tmp_name'])){
          move_uploaded_file($_FILES['image']['tmp_name'], 'images/' .date('Ymd-His') .$_FILES['image']['name']);
          echo 'アップロード完了';
        }else{
          echo 'ファイルが選択されていません';
        }


    }
}
