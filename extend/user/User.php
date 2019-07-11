<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019-07-11
 * Time: 15:20
 */

namespace extend\user;

use think\Db;

class User
{
    public static function userRegister($idcard, $password, $repassword, $verify, &$msg = '')
    {
        if(empty($idcard) || empty($password) || empty($repassword) || empty($verify)){
            $msg = '参数错误！';
            return false;
        }

        if(!checkVerify($verify)){
            $msg = '验证码错误';
            return false;
        }

        if($password != $repassword){
            $msg = '两次输入密码不一致！';
            return false;
        }

        if(!isCreditNo($idcard)){
            $msg = '请输入正确的身份证号！';
            return false;
        }

        if($has = Db::name('user')->where('idcard',$idcard)->find()){
            $msg = '该用户已注册！';
            return false;
        }
        $ins_data = ['idcard' => $idcard, 'password' => mkPassword($password), 'addtime' => time()];
        $msg = '注册成功，即将跳转登录页！';
        return $register = Db::name('user')->insertGetId($ins_data);
    }

    public static function userLogin($idcard, $password, $verify, &$msg = '')
    {
        if(empty($idcard) || empty($password) || empty($verify)){
            $msg = '参数错误';
            return false;
        }

        if(!checkVerify($verify)){
            $msg = '验证码错误！';
            return false;
        }

        if(!$has = Db::name('user')->where('idcard',$idcard)->find()){
            $msg = '该用户尚未注册';
            return false;
        }

        if($has['password'] != mkPassword($password)){
            $msg = '密码错误！';
            return false;
        }else{
            $msg = '登录成功';
            return $has;
        }
    }
}