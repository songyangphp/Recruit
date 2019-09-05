<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019-07-11
 * Time: 16:35
 */

namespace app\index\controller;

use extend\cache\Cache;
use think\Db;

class Home extends Base
{
    public function index()
    {
        /*$ywid = 1;
        Cache::set($ywid."user" , [1,2,3]);
        $aaa = Cache::get($ywid."user");
        dump($aaa);die;*/
        $nodes = Db::name("user_role")->where("id",$this->role_id)->value('node_ids');
        $menu = Db::name("node")->where("id","in",$nodes)->select();
        $menu = $this->getTree($menu,0,0);
        $this->assign("menu",$menu);

        return $this->fetch();
    }


    private function getTree($arr, $id, $level){
        $list = [];

        foreach ($arr as $k => $v) {
            if ($v['pid'] == $id) {
                $v['level'] = $level;
                $v['son'] = $this->getTree($arr, $v['id'], $level + 1);
                $list[] = $v;
            }
        }

        return $list;
    }

    public function welcome()
    {
        return $this->fetch();
    }
}