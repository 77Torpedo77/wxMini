<?php
namespace app\user\controller;

use AipOcr\AipOcr;
//use think\console\command\make\Controller;
use think\facade\Request;
use app\user\model\Users;
use app\user\model\Config;
use app\user\model\Element;
use app\user\model\Token;
use think\Controller;

class Api extends Controller
{   
    function initialize()
    {
        session_start();
        $this->appid ='wxb780f2caed5651b3';
        $this->secret = '9c5743bfa94f66d64ce4d180f6cc1353';
        $this->APP_ID = '20249056';
        $this->API_KEY = 'c6XL0H0l9q6HGa5CmfYvICeX';
        $this->SECRET_KEY = 'HBA0KMzG0TphKwYC0PL5aV7U0s1oIB0F';
        $this->admin_name = 'star'; //管理员名称
    }
    public function index()
    {
        return 'hello';
    }
    
    public function login()
    {
        $appid = $this->appid;
        $secret = $this->secret;
        $code = Request::get('code');
        if (empty($code)) {
            $return_data['errcode'] = -1;
            $return_data['errmsg'] = '登录code为空，请检查';
            return json($return_data);
        }
        $url = 'https://api.weixin.qq.com/sns/jscode2session?appid='.$appid. '&secret=' . $secret . '&js_code=' . $code . '&grant_type=authorization_code';
        $res = $this->curl_get($url);
        return json($res['openid']);
    }

    public function getImage()
    {
        $token = $this->getToken();
        $url = 'https://api.weixin.qq.com/wxa/getwxacodeunlimit?access_token='.$token;
        $data = array('scene'=>'123456');
        $res = $this->curl_post($url,$data);
        //return json($res);
        file_put_contents('image.jpg',$res);
        $request = Request::instance();
        return ($request->domain() .'/image.jpg');
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
        $APP_ID = $this->APP_ID;
        $API_KEY = $this->API_KEY;
        $SECRET_KEY = $this->SECRET_KEY;
        $admin_name = $this->admin_name; //管理员名称
        $image = Request::post('image');
        $language = Request::post('language');
        $openid = Request::post('openid');
        if (empty($language) || empty($openid) || empty($image)) {
            $return_data['errcode'] = -1;
            $return_data['errmsg'] = '有参数为空';
            return json($return_data);
        }

        $client = new AipOcr($APP_ID, $API_KEY, $SECRET_KEY);
        $image = base64_decode($image);
        // 调用通用文字识别（高精度版）
        $client->basicAccurate($image);
        // 如果有可选参数
        $options = array();
        $options["detect_direction"] = "true";
        $options["language_type"] = $language;

        //验证是否达到次数
        $config = Config::where('username', $admin_name)->find();
        if ($config->open_times_limit == 1) {
            try {
                $this->check_five_times($openid);
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
            return 'ocr出错，请联系管理员';
        }
    }
    /**
     * 查询有害成分接口（post）
     * 请求参数：
     * language 语言 - CHN：中文；- ENG：英文；- JAP：日语；- KOR：韩语；
     * data 待查询字符串，例：“成分一，成分二”
     *
     * @return json
     */
    public function checkElement()
    {
        $language = strtolower(Request::post('language'));
        $data = Request::post('data');
        if (empty($language) || empty($data)) {
           $return_data['errcode'] = -1;
           $return_data['errmsg'] = '有参数为空';
           return json($return_data);
        }
        try {
            $canUseData = $this->data_process($data);
        } catch (\Exception $e) {
            $einfo['errcode'] = $e->getCode();
            $einfo['errmsg'] = $e->getMessage();
            return json($einfo);
        }
        $map[0] = $language;
        foreach ($canUseData as $key => $value) {
            //$map[$key+1] = ['like','%'.trim($value).'%'];
            $map[$key + 1] = ['like',trim($value)];
        }
       // $map[$key+2] = ['like','*****************']; //tp5设计缺陷，whereor必须传两个，所以在后面加一个不可能查询到的条件防止出错
        $map[$key + 2] = ['like','*****************'];
        $harm = Element::whereOr([$map])->select();
        if (empty($harm[0])) {
            $return_data['errcode'] = -1;
            $return_data['errmsg'] = '未查询到结果';
            return json($return_data);
        }
        for ($i=0; $i < count($harm); $i++) {
            if ($language != 'chn') {
                $return_data[$i]['chn'] = $harm[$i]->chn;
            } 
            $return_data[$i]['element'] = $harm[$i]->$language;
            $return_data[$i]['alias'] = $harm[$i]->alias;
            $return_data[$i]['harm'] = $harm[$i]->harm;
        }
        
        return json($return_data);
    }

    function data_process($data = '')
    {
        if ($data == '') {
            throw new \Exception("传入数据为空", -1);
        }
        preg_match_all("/,|，| |、/U", $data, $out);
        if (empty($out[0])) {
            return array($data);
        }
        $out = array_count_values($out[0]);
        arsort($out);
        $separator = array_keys($out)[0];
        //$res = explode($separator, $data);
        $res = preg_split("/(【|】|：|:|$separator)/", $data);
        $res = array_values(array_filter($res));//去掉空值并使下标重新从0开始
        if (empty($res[0])) {
            throw new \Exception("传入数据格式有误", -1);
        }
        return array_filter($res);
    }

    function curl_get($url)
    {
        $ci = curl_init();
        /* Curl settings */
        curl_setopt($ci, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ci, CURLOPT_TIMEOUT, 30);
        curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ci, CURLOPT_URL, $url);
        curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, false);    //禁止 cURL 验证对等证书
        curl_setopt($ci, CURLOPT_SSL_VERIFYHOST, false);    //是否检测服务器的域名与证书上的是否一致

        $response = curl_exec($ci);

        curl_close($ci);
        $info = json_decode($response, TRUE);
        return $info;
    }

    function curl_post($url,$data=array())
    {
        $ci = curl_init();
        $data = json_encode($data);
        /* Curl settings */
        //curl_setopt($ci, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ci, CURLOPT_TIMEOUT, 30);
        curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ci, CURLOPT_URL, $url);
        curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, false);    //禁止 cURL 验证对等证书
        curl_setopt($ci, CURLOPT_SSL_VERIFYHOST, false);    //是否检测服务器的域名与证书上的是否一致

        //curl_setopt($ci, CURLOPT_POST, 1);                  //post
        curl_setopt($ci, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ci, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ci, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json;charset=utf-8',
            'Content-Length: ' . strlen($data)
        ));
        
        $response = curl_exec($ci);
       // return curl_error($ci);
        curl_close($ci);
        //$info = json_decode($response, TRUE);
        return $response;
    }

    function check_five_times($openid = '666')
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

    /**
     * getToken 获取access_token
     *
     * @return json
     */
    function getToken()
    {
        $appid = $this->appid;
        $secret = $this->secret;
        $url = 'https://api.weixin.qq.com/cgi-bin/token?&appid=' . $appid . '&secret=' . $secret . '&grant_type=client_credential';
        $now = strtotime("now");
        $oldtoken = Token::find();
        // $res = $this->curl_get($url);
        if (empty($oldtoken)) {
            $res = $this->curl_get($url);
            $token = new Token();
            $token->token = $res['access_token'];
            $token->time = $now;
            $token->save();
        }
        $ispast = $now - $oldtoken->time;
        if ($ispast >= 7200) {
            $res = $this->curl_get($url);
            $token = Token::find();
            $token->token = $res['access_token'];
            $token->time = $now;
            $token->save();
            return $res['access_token'];
        }
        return $oldtoken->token;
    }

    function test()
    {
        $data = '【成分】：乙醇，哈哈';
        $data = $this->data_process($data);
        print_r($data);
    }
    function api_notice_increment($url, $data)
    {
        $data = json_encode($data);
        $ch = curl_init();
        $header = array(
            'Content-Type: application/json;charset=utf-8',
            'Content-Length: ' . strlen($data)
        );
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $tmpInfo = curl_exec($ch);
        if (curl_errno($ch)) {
            return false;
        } else {
            return $tmpInfo;
        }
    }
}


