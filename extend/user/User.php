<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019-07-11
 * Time: 15:20
 */

namespace extend\user;

use think\Db;
use think\Session;

class User
{
    public static function userRegister($username, $password, $repassword, $verify, &$msg = '')
    {
        if(empty($username) || empty($password) || empty($repassword) || empty($verify)){
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

        if(!isCreditNo($username)){
            $msg = '请输入正确的身份证号！';
            return false;
        }

        if($has = Db::name('user')->where('username',$username)->find()){
            $msg = '该用户已注册！';
            return false;
        }
        $ins_data = ['idcard' => $username, 'password' => mkPassword($password), 'addtime' => time()];
        $msg = '注册成功，即将跳转登录页！';
        return $register = Db::name('user')->insertGetId($ins_data);
    }

    public static function userLogin($username, $password, $verify, &$msg = '')
    {
        if(empty($username) || empty($password) || empty($verify)){
            $msg = '参数错误';
            return false;
        }

        if(!checkVerify($verify)){
            $msg = '验证码错误！';
            return false;
        }

        $has = Db::name('user')->where("username|phone|email",'EQ',$username)->find();

        if(!$has){
            $msg = '该用户尚未注册';
            return false;
        }

        if($has['password'] != mkPassword($password)){
            $msg = '密码错误！';
            return false;
        }else{
            Session::set('uid',$has['id']);
            $msg = '登录成功';
            return $has;
        }
    }

    public static function getUserRealNameByUid($uid)
    {
        return self::getUserByUid($uid)['name'];
    }

    private static function getUserByUid($uid)
    {
        return Db::name('user')->where("id = {$uid}")->find();
    }
}