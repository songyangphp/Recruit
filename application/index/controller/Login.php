<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019-07-11
 * Time: 11:30
 */

namespace app\index\controller;


use think\Controller;
use extend\user\User;
use think\Session;

class Login extends Controller
{
    public function verify()
    {
        return getVerify();
    }

    public function index()
    {
        return $this->fetch();
    }

    public function Login()
    {
        $idcard = $this->request->param('username/s','','trim');
        $password = $this->request->param('password/s','','trim');

        $msg = '';
        if(!$login = User::userLogin($idcard,$password,$msg)){
            $this->error($msg);
        }else{
            Session::set('uid',$login['id']);
            $this->success($msg,url('Home/index'));
        }
    }
}