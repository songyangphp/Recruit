<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019-11-14
 * Time: 10:18
 */

namespace extend\user;

use think\Db;

class Role
{
    public static function getRoleByUid($uid)
    {
        $role_id = Db::name("user")->where("id",$uid)->value("role_id");
        $role = Db::name('user_role')->where('id',$role_id)->find();
        return $role;
    }
}