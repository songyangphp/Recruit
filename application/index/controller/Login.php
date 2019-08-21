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

class Login extends Controller
{
    public function verify()
    {
        return getVerify();
    }

    public function index()
    {
        return $this->fetch('login/index');
    }

    public function Login()
    {
        $idcard = $this->request->param('username/s','','trim');
        $password = $this->request->param('password/s','','trim');
        $verify = $this->request->param('verify/s','','trim');

        $msg = '';
        if(!User::userLogin($idcard,$password,$verify,$msg)){
            $this->error($msg);
        }else{
            $this->redirect(url('Home/index'));
        }
    }
}