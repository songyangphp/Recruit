<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019-07-11
 * Time: 16:35
 */

namespace app\index\controller;

class Home extends Base
{
    public function index()
    {
        $menu = [
            [
                "id" => 1,
                "name" => "菜单管理",
                "url" => "__APP__",
                "son" => [
                    [
                        "id" => 2,
                        "name" => "前台菜单管理",
                        "url" => url('Menu/index'),
                    ]
                ]
            ],
            [
                "id" => 3,
                "name" => "邮件管理",
                "url" => "",
                "son" => []
            ]
        ];

        $this->assign("menu",$menu);
        return $this->fetch();
    }

    public function welcome()
    {
        return $this->fetch();
    }
}