<?php
namespace app\user\controller;


use app\user\model\Users;
use app\user\model\Config;
use app\user\model\Element;
use Workerman\Events\Select;

class Admin extends \think\Controller
{
    function initialize()
    {
        session_start();
        $this->ConfigModel = new Config();
        $this->ElementModel = new Element();
        $this->UserModel = new Users();
    }

    //登录
    function login()
    {
        if (!empty($_SESSION['islogin'])) {
            $this->redirect("/user/admin/");
        }
        if (!empty($_POST['username']) && !empty($_POST['password'])) {
            $admin = $this->ConfigModel->where("username", $_POST['username'])->find();
            if ($admin->username == $_POST['username'] && $admin->password == md5($_POST['password'])) {
                $_SESSION['islogin'] = $admin;
                $this->success('登录成功', '/user/admin/');
            } else {
                $this->error('用户名或密码错误');
            }
        } else {
            return $this->fetch();
        }
    }

    //成分列表
    function elementlist()
    {
        if (empty($_SESSION['islogin'])) {
            $this->redirect("/user/admin/login");
        }
        $element_list = $this->ElementModel->select();
        $this->assign("element_list", $element_list);
        return $this->fetch();
    }

    //增加成分
    function add()
    {
        if (empty($_SESSION['islogin'])) {
            $this->redirect("/user/admin/login");
        }
        if (!empty($_POST['submit'])) {
            if (empty($_POST['harm'])) {
                $this->error('危害为空');
            }
            if (empty($_POST['name1']) || empty($_POST['name2']) || empty($_POST['name3']) || empty($_POST['name4']) || empty($_POST['name5'])) {
                $this->error('某一名称为空，若无该名称，请填入null');
            }
            $new_element = new Element;
            $new_element->chn = $_POST['name1'];
            $new_element->eng = $_POST['name2'];
            $new_element->jap = $_POST['name3'];
            $new_element->kor = $_POST['name4'];
            $new_element->alias = $_POST['name5'];
            $new_element->harm = $_POST['harm'];
            $new_element->save();
            $this->success('增加成功', "/user/admin/elementlist");
        } else {
            return $this->fetch();
        }
    }
    //删除成分
    function remove($remove_id = 0)
    {
        if (empty($_SESSION['islogin'])) {
            $this->redirect("/user/admin/login");
        }
        if ($remove_id > 0) {
            $this->ElementModel->where("id", $remove_id)->delete();
            $this->success('删除成功', "/user/admin/elementlist");
        }
    }

    //更新成分
    function update($update_id = -1)
    {
        if (empty($_SESSION['islogin'])) {
            $this->redirect("/user/admin/login");
        }
        if($update_id != -1){
            $update_element = Element::where('id', $update_id)->find();
            $html_data['id'] =$update_element->id;
            $html_data['chn'] =$update_element->chn;
            $html_data['eng'] =$update_element->eng;
            $html_data['jap'] =$update_element->jap;
            $html_data['kor'] =$update_element->kor;
            $html_data['alias'] =$update_element->alias;
            $html_data['harm'] =$update_element->harm;
            $this->assign('html_data', $html_data);
        }

        if (!empty($_POST['submit'])) {
            if (empty($_POST['id'])) {
                $this->error('id为空');
            }
            $update_id = $_POST['id'];
            if (empty($_POST['harm'])) {
                $this->error('危害为空');
            }
            if (empty($_POST['name1']) || empty($_POST['name2']) || empty($_POST['name3']) || empty($_POST['name4']) || empty($_POST['name5'])) {
                $this->error('某一名称为空，若无该名称，请填入null');
            }
            $update_element = Element::where('id', $update_id)->find();
            $update_element->chn = $_POST['name1'];
            $update_element->eng = $_POST['name2'];
            $update_element->jap = $_POST['name3'];
            $update_element->kor = $_POST['name4'];
            $update_element->alias = $_POST['name5'];
            $update_element->harm = $_POST['harm'];
            $flag = $update_element->save();
            if ($flag == true) {
                $this->success('更新成功', "/user/admin/elementlist");
            }
        } else {
            return $this->fetch();
        }
    }

    //设置界面
    function setting()
    {
        if (empty($_SESSION['islogin'])) {
            $this->redirect("/user/admin/login");
        }
        $admin = $this->ConfigModel->select();
        if ($admin[0]->open_times_limit == 1) {
            $this->assign("status", "开启");
            return $this->fetch();
        }
        if ($admin[0]->open_times_limit == 0) {
            $this->assign("status", "关闭");
            return $this->fetch();
        }
    }

    //开启关闭限制
    function limit($limit_code = 0)
    {
        if (empty($_SESSION['islogin'])) {
            $this->redirect("/user/admin/login");
        }
        $admin = $this->ConfigModel->select()[0];
        if ($limit_code == 1) {
            $admin->open_times_limit = 1;
            $admin->save();
            $this->success('开启成功', "/user/admin/setting");
        }
        if ($limit_code == 0) {
            $admin->open_times_limit = 0;
            $admin->save();
            $this->success('关闭成功', "/user/admin/setting");
        }
    }

    function index()
    {
        if (empty($_SESSION['islogin'])) {
            $this->redirect("/user/admin/login");
        }
        return $this->fetch();
    }
}
