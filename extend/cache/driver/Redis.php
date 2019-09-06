<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019-09-05
 * Time: 16:40
 */

namespace extend\cache\driver;

use think\cache\driver\Redis as TpRedis;

//redis-server.exe redis.windows.conf
//
/*启动失败解决办法：
redis-cli.exe
127.0.0.1:6379>shutdown
not connected>exit
重新运行redis-server.exe redis.windows.conf*/

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

    /**
     * @param $name
     * @param $value
     * @param $cover //是否强制覆盖
     * @return bool
     */
    public function set($name, $value, $cover)
    {
        $has = (bool)self::getInstance()->has($name);
        if($has){
            if($cover){
                self::getInstance()->rm($name);
                return self::getInstance()->set($name, $value);
            }else{
                return true;
            }
        }else{
            return self::getInstance()->set($name, $value);
        }
    }

    /**
     * @param $name
     * @return mixed
     */
    public function get($name)
    {
        return self::getInstance()->get($name);
    }
}