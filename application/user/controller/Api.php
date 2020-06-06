<?php
namespace app\user\controller;

use AipOcr\AipOcr;
use think\console\command\make\Controller;
use think\facade\Request;
use app\user\model\Users;

//curl_setopt($ch, CURLOPT_POST, 1);
class Api extends Controller
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
        return json($res['openid']);

    }


    /**
     * 图片识别接口（post）
     * 请求参数：
     * language 语言 - CHN_ENG：中英文混合；- ENG：英文；- JAP：日语；- KOR：韩语；
     * image base64图片编码
     * 
     * 
     * 
     * @return json 
     */
    public function ocr()
    {
        // 你的 APPID AK SK
        $APP_ID = '20249056';
        $API_KEY = 'c6XL0H0l9q6HGa5CmfYvICeX';
        $SECRET_KEY = 'HBA0KMzG0TphKwYC0PL5aV7U0s1oIB0F';

        $client = new AipOcr($APP_ID, $API_KEY, $SECRET_KEY);
        $image = Request::post('image');
       // $image = base64_decode(explode(',',$image)[1]);
        
        // 调用通用文字识别（高精度版）
        $client->basicAccurate($image);

        // 如果有可选参数
        $options = array();
        $options["detect_direction"] = "true";
        $options["language_type"] = Request::post('language');

        // 带参数调用通用文字识别（高精度版）
        return json($client->basicAccurate($image, $options));
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

    public function check_five_times($openid)
    {
        $auser = new Users();

    }
}


