<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019-07-11
 * Time: 16:35
 */

namespace app\index\controller;


use think\Controller;
use think\Request;
use think\Session;
//test.recruit.com
class Base extends Controller
{
    protected $uid = 0;

    public function __construct(Request $request = null)
    {
        $this->uid = (int)Session::get('uid');
        if(empty($this->uid)){
            $this->redirect(url('Login/index'));
        }
        parent::__construct($request);
    }
}