<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019-09-05
 * Time: 16:40
 */

namespace extend\cache\driver;


interface Idriver
{
    public function set($name,$value);

    public function get($name);
}