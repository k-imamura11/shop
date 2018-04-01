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
              // Session::flash('success_message', 'アップロード完了');
            //上記以外の場合
            }else{
              Session::flash('message', 'ファイルアップロード失敗');
            }
          }

      }

    //商品情報追加　get
    public function getAddProduct(){
      return view('admin.productmanage');
    }

    //商品情報追加　post
    public function postAddProduct(){

      //POSTデータ取得
      if(!empty($_POST)){
        $title = $this-> formCheck($_POST['title']);
        $genres = $_POST['genre'];
        $quantity = $this->formCheck($_POST['quantity']);
        $price = $this-> formCheck($_POST['price']);
        $detail = $this-> formCheck($_POST['detail']);
        $description = $this-> formCheck($_POST['description']);
        $image_url_1 = $_FILES['image_url_1']['name'];
        $image_url_2 = $_FILES['image_url_2']['name'];
        $image_url_3 = $_FILES['image_url_3']['name'];
      }

      //フォームの入力チェック
      $title = $this-> textCheck($title);
      $price = $this-> numCheck($price);
      $quantity = $this-> numCheck($quantity);

      DB::beginTransaction();
      try{
        //画像アップロード
        $this-> postUpload('image_url_1');
        $this-> postUpload('image_url_2');
        $this-> postUpload('image_url_3');

        //DBへinsert
        //Productのインスタンス
        $product = new Product;

        $product-> title = $title;

        //genreの紐づけ
        switch($genres){
          case 'メンズファッション':
            $genre = 1;
            break;
          case 'レディースファッション':
            $genre = 2;
            break;
          case 'キッズ・ベビー':
            $genre = 3;
            break;
          case '時計・アクセサリー':
            $genre = 4;
            break;
        }

        $product-> genre = $genre;
        $product-> quantity = $quantity;
        $product-> price = $price;
        $product-> detail = $detail;
        $product-> description = $description;
        $product-> image_url_1 = date('Ymd-His') .$image_url_1;
        if(!empty($image_url_2)){
          $product-> image_url_2 = date('Ymd-His') .$image_url_2;
        }
        if(!empty($image_url_3)){
          $product-> image_url_3 = date('Ymd-His') .$image_url_3;
        }

        $product-> save();
        Session::flash('success_message', '商品の登録が完了しました。');

      DB::commit();
      }catch(\Exception $e){
        logger($e-> getMessage());
        //フォームエラーがある場合は表示しない
        if(!Session::has('message')){
          Session::flash('message', '登録できませんでした。');
        }

      DB::rollBack();
      }

      return redirect()-> route('admin.productmanage');
    }

    //フォーム入力データを整形
    public function formCheck($string){
      $string = trim($string);
      $string = stripslashes($string);
      $string = htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
      return $string;
    }

    //テキスト系の入力チェック
    public function textCheck($text){

      switch($text){
        case($_POST['title']):
          $type = 'タイトル';
          break;
        default:
          $type = '';
          break;
      }

      if(empty($text)){
        return redirect()-> route('admin.productmanage')-> with('message', $type .'は必須項目です。');
      }
      return $text;
    }

    //数値系の入力チェック
    public function numCheck($num){

      switch($num){
        case ($_POST['quantity']):
          $type = '数量';
          break;
        case ($_POST['price']):
          $type = '価格';
          break;
        default:
          $type = '';
          break;
      }

      if(empty($num)){
        return redirect()-> route('admin.productmanage')-> with('message', $type .'は必須項目です。');
      }
      //半角数字のみ許容
      if(!preg_match('/^[0-9]+$/D', $num)){
        return redirect()-> route('admin.productmanage')-> with('message', $type.'は半角数字のみ入力できます。');
      }
      return $num;
    }

    public function getProductdetail($id){
      $products = DB::table('products')
                    ->select('products.*', 'genre.genre_name')
                    ->join('genre', 'products.genre', '=', 'genre.id')
                    ->where('products.id', '=', $id)
                    ->get();

      return view('admin.productdetail', ['products' => $products]);
    }

    public function getUpdateProduct($id){
      $url = url('admin/productdetail/' .$id);
      return redirect($url);
    }

    //商品情報更新
    public function postUpdateProduct($id){

      //POSTデータ取得
      if(!empty($_POST)){
        $title = $this-> formCheck($_POST['title']);
        $genres = $_POST['genre'];
        $quantity = $this->formCheck($_POST['quantity']);
        $price = $this-> formCheck($_POST['price']);
        $detail = $this-> formCheck($_POST['detail']);
        $description = $this-> formCheck($_POST['description']);
        $image_url_1 = $_FILES['image_url_1']['name'];
        $image_url_2 = $_FILES['image_url_2']['name'];
        $image_url_3 = $_FILES['image_url_3']['name'];
      }

      //フォームの入力チェック
      $title = $this-> textCheck($title);
      $price = $this-> numCheck($price);
      $quantity = $this-> numCheck($quantity);

      DB::beginTransaction();
      try{

        // //画像アップロード
        if(!empty($_FILES['image_url_1'])){
          $this-> postUpload('image_url_1');
        }
        if(!empty($_FILES['image_url_2'])){
          $this-> postUpload('image_url_2');
        }
        if(!empty($_FILES['image_url_3'])){
          $this-> postUpload('image_url_3');
        }

        //genreの紐づけ
        switch($genres){
          case 'メンズファッション':
            $genre = 1;
            break;
          case 'レディースファッション':
            $genre = 2;
            break;
          case 'キッズ・ベビー':
            $genre = 3;
            break;
          case '時計・アクセサリー':
            $genre = 4;
            break;
        }

        $sql = ['title' => $title, 'genre' => $genre, 'quantity' => $quantity, 'price' => $price, 'detail' => $detail, 'description' => $description];

        if(!empty($image_url_1)){
          $sql = array_merge($sql, ['image_url_1' => date('Ymd-His') .$image_url_1]);
          if(!empty($image_url_2)){
            $sql = array_merge($sql, ['image_url_2', date('Ymd-His') .$image_url_2]);
            if(!empty($image_url_3)){
              $sql = array_merge($sql, ['image_url_3' => date('Ymd-His') .$image_url_3]);
            }
          }
        }

        Product::where('id', $id)-> update($sql);
        Session::flash('success_message', '商品情報を更新しました。');

      DB::commit();
      }catch(\Exception $e){
        logger($e-> getMessage());
        //フォームエラーがある場合は表示しない
        if(!Session::has('message')){
          Session::flash('message', '登録できませんでした。');
        }

      DB::rollBack();
      }

      $url = url('admin/productdetail/' .$id);
      return redirect($url);
    }

}
