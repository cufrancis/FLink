<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Session;

use Auth;
use View;


class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    /**
     * 操作成功提示
     * @param $url string
     * @param $message 消息内容
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    protected function success($url,$message)
    {
        Session::flash('message',$message);
        Session::flash('message_type',2);
        return redirect($url);
    }

    /**
     * 操作错误提示
     * @param  string $url     string
     * @param  string $message 消息内容
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector        跳转链接
     */
    protected function error($url,$message)
    {
        Session::flash('message',$message);
        Session::flash('message_type',1);
        return redirect($url);
    }
}
