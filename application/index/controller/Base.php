<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019-07-11
 * Time: 16:35
 */

namespace app\index\controller;


use think\Controller;
use think\Db;
use think\Request;
use think\Session;
//test.recruit.com
class Base extends Controller
{
    protected $uid = 0;

    protected $role_id = 0;
    protected $role_name = null;

    public function __construct(Request $request = null)
    {
        $this->uid = (int)Session::get('uid');
        if(empty($this->uid)){
            $this->redirect(url('Login/index'));
        }

        $this->initRole($this->uid);
        parent::__construct($request);
    }

    private function initRole($uid)
    {
        $role_id = Db::name("user")->where("id",$uid)->value("role_id");
        $this->role_id = $role_id;
        $role_name = Db::name("user_role")->where("id",$this->role_id)->value("name");
        $this->role_name = $role_name;
    }
}