<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019-07-08
 * Time: 15:38
 */
namespace app\index\controller;

use think\Controller;
use app\index\model\User as UserModel;
use think\Request;
use think\Db;

class User extends Controller
{
    private static $_user_model;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        self::$_user_model = new UserModel();
    }

    public function index()
    {
        //$a = self::$_user_model->add('楚云飞','17796908132');
        //$b = self::$_user_model->edit(['u_name' => rand(1,10)],['id' => 3]);
        //var_dump($b);
        //$c = self::$_user_model->remove(4);
        //$list = self::$_user_model->show();
        $list = Db::name('user')->paginate(10)->each(function($item,$key){
            $item['addtime'] = time();
            return $item;
        });

        /*print_r($list);*/
        $this->assign('list',$list);
        $this->assign('page', $list->render());
        return $this->fetch();
    }
}