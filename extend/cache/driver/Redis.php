<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019-09-05
 * Time: 16:40
 */

namespace extend\cache\driver;

use think\cache\driver\Redis as TpRedis;

class Redis implements Idriver
{
    public static $_tp_redis;

    public static function getInstance()
    {
        if(self::$_tp_redis instanceof TpRedis){
            return self::$_tp_redis;
        }
        return self::$_tp_redis = (new TpRedis());
    }

    public function set($name, $value)
    {
        return self::getInstance()->set($name, $value);
    }

    public function get($name)
    {
        return self::getInstance()->get($name);
    }
}