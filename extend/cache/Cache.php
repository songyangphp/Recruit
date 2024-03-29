<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019-09-05
 * Time: 16:38
 */

namespace extend\cache;


use extend\cache\driver\Idriver;

class Cache
{
    const DRIVER = 'Redis'; //memcache redis mysql file

    private static $_cache_driver;

    private static function getInstance(Idriver $driver)
    {
        if(self::$_cache_driver instanceof Idriver){
            return self::$_cache_driver;
        }

        return self::$_cache_driver = (new $driver);
    }

    public static function set($name, $value, $cover = true)
    {
        switch (self::DRIVER){
            case 'Redis' : return self::getInstance(new \extend\cache\driver\Redis())->set($name, $value, $cover); break ;
            default : exit('无此驱动') ;
        }
    }

    public static function get($name)
    {
        switch (self::DRIVER){
            case 'Redis' : return self::getInstance(new \extend\cache\driver\Redis())->get($name); break ;
            default : exit('无此驱动') ;
        }
    }
}