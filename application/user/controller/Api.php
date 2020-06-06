<?php
namespace app\user\controller;

use AipOcr\AipOcr;
use think\console\command\make\Controller;
use think\facade\Request;
use app\user\model\Users;
use app\user\model\Config;

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
        $admin_name = 'star';//管理员名称

        $client = new AipOcr($APP_ID, $API_KEY, $SECRET_KEY);
        $image = Request::post('image');
       // $image = base64_decode(explode(',',$image)[1]);
        $image = base64_decode($image);
        // 调用通用文字识别（高精度版）
        $client->basicAccurate($image);

        // 如果有可选参数
        $options = array();
        $options["detect_direction"] = "true";
        $options["language_type"] = Request::post('language');

        //验证是否达到次数
        $config = Config::where('username', $admin_name)->find();
        if ($config->open_times_limit == 1) {
            try {
                $this->check_five_times(Request::post('openid'));
                return json($client->basicAccurate($image, $options));
            } catch (\Exception $e) {
                $einfo['errcode'] = $e->getCode();
                $einfo['errmsg'] = $e->getMessage();
                return json($einfo);
            }
        }
        elseif ($config->open_times_limit == 0) {
            return json($client->basicAccurate($image, $options));
        }
        else{
            return '出错了，请联系管理员';
        }
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

    public function check_five_times($openid = '666')
    {
        $now = strtotime("now");
        $olduser = Users::where('openid',$openid)->find();
        if (!isset($olduser)) {
            $auser = new Users();
            $auser->openid = $openid;
            $auser->times = 0;
            $auser->day = $now;
            $auser->save();
        }
        $olduser = Users::where('openid', $openid)->find();
        //判断是否过了一天
       ;
        $isTmr = date('d', $now) - date('d',$olduser->day);

        if ($olduser->times == 5 && $isTmr == 0) {
            throw new \Exception("今日尝试次数已到五次", -1);
        }
        //第二天再调用首先清空次数
        elseif ($isTmr>0) {
            $olduser->times = 0;
            $olduser->day = $now;
            $olduser->save();
        }
        $olduser->times = $olduser->times + 1;
        $olduser->save();
        return true;


    }
}


