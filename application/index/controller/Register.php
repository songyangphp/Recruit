<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019-07-11
 * Time: 14:21
 */

namespace app\index\controller;


use extend\user\User;
use think\Controller;

class Register extends Controller
{
    public function index()
    {
        return $this->fetch('register/index');
    }

    public function register()
    {
        $idcard = $this->request->param('username/s','','trim');
        $pass = $this->request->param('password/s','','trim');
        $repass = $this->request->param('repassword/s','','trim');

        $msg = '';
        if(!User::userRegister($idcard,$pass,$repass,$msg)){
            $this->error($msg);
        }else{
            $this->success($msg,url('Login/index'));
        }
    }
}