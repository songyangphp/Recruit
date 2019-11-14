<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019-07-11
 * Time: 16:35
 */

namespace app\index\controller;

use extend\user\User;
use extend\user\Role;
use think\Controller;
use think\Request;
use think\Session;

//test.recruit.com
class Base extends Controller
{
    protected $uid = 0;

    protected $role_id = 0;
    protected $role_name = null;
    protected $user_name = null;

    public function __construct(Request $request = null)
    {
        $this->uid = (int)Session::get('uid');
        if(empty($this->uid)){
            $this->redirect(url('Login/index'));
        }
        $this->user_name = User::getUserRealNameByUid($this->uid);
        $this->initRole();
        parent::__construct($request);
    }

    private function initRole()
    {
        $role = Role::getRoleByUid($this->uid);
        $this->role_id = $role['id'];
        $this->role_name = $role['name'];
    }
}