<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductManagement;
use DB;
use Session;

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

    //画像アップロード(共通処理)
    public function postUpload($fname){
      try{
          if(is_uploaded_file($_FILES[$fname]['tmp_name'])){
            //エラーコード2　ファイルサイズ超過の場合
            if($_FILES[$fname]['error'] === 2){
              Session::flash('message', 'ファイルサイズを小さくしてください。');
            //ファイルサイズが0(空)の場合
            }else if($_FILES[$fname]['size'] === 0){
              Session::flash('message', 'ファイルを選択してください。');
            //ファイルサイズが2MBより大きい場合
          }else if($_FILES[$fname]['size'] > 2000000){
            Session::flash('message', 'ファイルサイズは2MBまでにしてください。');
            //MIMEタイプチェック　拡張子が画像ファイル以外の場合
            }else if($_FILES[$fname]['type'] !== 'image/jpeg' && $_FILES[$fname]['type'] !== 'image/png' && $_FILES[$fname]['type'] !== 'image/gif'){
              Session::flash('message', '拡張子はjpeg,png,gifのみ有効です。');
            //ファイルアップロード成功
            }else if($_FILES[$fname]['error'] === 0){
              move_uploaded_file($_FILES[$fname]['tmp_name'], 'images/' .date('Ymd-His') .$_FILES[$fname]['name']);
              //権限は今のところ変更いらない
              // chmod('images/' .date('Ymd-His') .$_FILES[$fname]['name'], 777);
              Session::flash('success_message', 'アップロード完了');
            //上記以外の場合
            }else{
              Session::flash('message', 'ファイルアップロード失敗');
            }
          }
        //例外処理は念のため
        }catch(\Exception $e){
          Session::flash('message', $e-> getMessage());
        }
      }

    //商品情報追加　get
    public function getAddProduct(){
      return view('admin.productmanage');
    }

    //商品情報追加　post
    public function postAddProduct(Request $request){
      //画像アップロード
      $this-> postUpload('image_url_1');

      $this-> validate($request, [
        'title' => 'required|max:50',
        'genre' => 'required',
        'quantity' => 'required|numeric',
        'price' => 'required|numeric',
        'image_url_1' => 'required',
      ]);

      $title = $request-> input['title'];
      $genre = $request-> input['genre'];
      $quantity = $request-> input['quantity'];
      $price = $request-> input['price'];
      // $detail = $request-> input['detail'];
      // $description = $request-> input['description'];
      $image_url_1 = date('Ymd-His') .$_FILES['image_url_1']['name'];
      // $image_url_2 = date('Ymd-His') .$_FILES['image_url_2']['name'];
      // $image_url_3 = date('Ymd-His') .$_FILES['image_url_3']['name'];

      //Productのインスタンス
      $product = new Product;

      $product-> title = $title;
      $product-> genre = $genre;
      $product-> quantity = $quantity;
      $product-> price = $price;
      // $product-> detail = $detail;
      // $product-> description = $description;
      $product-> image_url_1 = $image_url_1;
      // $product-> image_url_2 = $image_url_2;
      // $product-> image_url_3 = $image_url_3;

      return redirect()-> route('admin.productmanage');
    }

}
