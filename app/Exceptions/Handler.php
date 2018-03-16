<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {

      return parent::render($request, $exception);

//=================================================================================================
//      MultiAuthを使用しているためadminとuserの非認証時のリダイレクト先を下記ファイルに追加すること
//      **Illuminate\Foundation\Exceptions::unauthenticated();**
//==================================================================================================
//      //Multilogin実装のためadminの認証失敗時のリダイレクト先追加
//      if(in_array('admin', $exception-> guards(), true)){
//        return redirect()-> guest(route('admin.login'));
//      }
//        return redirect()-> guest(route('login'));
//      }
//
    }
}
