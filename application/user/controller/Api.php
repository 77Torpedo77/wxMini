<?php
namespace app\user\controller;

use think\facade\Request;

class Api 
{   
    public function index()
    {
        return 'hello';
    }
    
    public function login()
    {
        $appid = 'wxb780f2caed5651b3';
        $secret = '9c5743bfa94f66d64ce4d180f6cc1353';
        $code = Request::get('code');
        $url = 'https://api.weixin.qq.com/sns/jscode2session?appid='.$appid. '&secret=' . $secret . '&js_code=' . $code . '&grant_type=authorization_code';
        $res = $this->curl_get($url);
        return json($res);

    }

    public function curl_get($url)
    {
        $ci = curl_init();
        /* Curl settings */
        curl_setopt($ci, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ci, CURLOPT_TIMEOUT, 30);
        curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ci, CURLOPT_URL, $url);
        $response = curl_exec($ci);

        curl_close($ci);
        $info = json_decode($response, TRUE);
        return $info;
    }
}


