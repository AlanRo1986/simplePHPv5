<?php
/**
 * example:
 *  CacheProvider::set("test4","test redis");
 *  CacheProvider::get("test4",4);
 *  CacheProvider::set("test5",4);
 *  CacheProvider::increment("test5");
 *  CacheProvider::decrement("test5");
 *  CacheProvider::remove("test5");
 *  CacheProvider::set("test6",10);
 *  CacheProvider::exist("test6");
 *  CacheProvider::destroy();
 *
 * Created by PhpStorm.
 * User: Alan 341455770@qq.com
 * Date: 2017/05/22 0022
 * Time: 13:44
 */

namespace App\System\Storage;


use App\System\Basic\Provider;
use App\System\BasicInterface\StoreInterface;
use App\System\Handler\CacheFileHandler;
use App\System\Handler\CacheMemcachedHandler;
use App\System\Handler\CacheMemcacheHandler;
use App\System\Handler\CacheRedisHandler;
use App\System\Utils\TextUtils;

class CacheProvider extends Provider implements StoreInterface
{
    protected static $cache;

    /**
     * The first run the middleware.
     */
    public function middleware()
    {
        // TODO: Implement middleware() method.
    }

    /**
     * instance register.
     */
    public function register()
    {
        // TODO: Implement register() method.

        $cache = conf("cache",conf("cache","default"));

        switch (TextUtils::lower($cache['driver'])){
            case 'file':
                static::$cache = app(CacheFileHandler::class,$cache);
                break;
            case 'memcached':
                /**
                 * CacheMemcachedHandler.class I'm haven't test....
                 * I just test CacheMemcacheHandler.class because I'm develop in windows7.
                 * So http://memcached.org/ have not windows version.
                 * Your can test it.
                 *
                 * The class initialize in InitSystem.php:56,And it must be defined in ConstantConfig.php:cache
                 *
                 * example:
                 * CacheProvider::set("test4","test redis");
                 * CacheProvider::get("test4",4);
                 * CacheProvider::set("test5",4);
                 * CacheProvider::increment("test5");
                 * CacheProvider::decrement("test5");
                 * CacheProvider::remove("test5");
                 * CacheProvider::set("test6",10);
                 * CacheProvider::exist("test6");
                 * CacheProvider::destroy();
                 *
                 */
                static::$cache = app(CacheMemcachedHandler::class,$cache);
                //static::$cache = app(CacheMemcacheHandler::class,CACHE);
                break;
            case 'redis':
                static::$cache = app(CacheRedisHandler::class,$cache);
                break;
        }

    }



    /**
     * determine this key exist or not.
     * @param string $key
     * @return bool
     */
    public static function exist($key)
    {
        // TODO: Implement exist() method.
        if (self::$cache == null){
            return false;
        }

        return self::$cache->exist($key);
    }

    /**
     * get value by key.
     * @param string $key
     * @return mixed
     */
    public static function get($key)
    {
        // TODO: Implement get() method.
        if (self::$cache == null){
            return false;
        }

        return self::$cache->get($key);
    }

    /**
     * set value by key.
     * @param string $key
     * @param $val
     * @param int $expire
     * @return bool
     */
    public static function set($key, $val, $expire)
    {
        // TODO: Implement set() method.
        if (self::$cache == null){
            return false;
        }

        return self::$cache->set($key,$val);
    }

    /**
     * delete a key.
     * @param string $key
     * @return bool
     */
    public static function remove($key)
    {
        // TODO: Implement remove() method.

        if (self::$cache == null){
            return false;
        }

        return self::$cache->remove($key);
    }

    /**
     * clear all the keys.
     * @return bool
     */
    public static function destroy()
    {
        // TODO: Implement destroy() method.

        if (self::$cache == null){
            return false;
        }

        return self::$cache->destroy();
    }

    /**
     * @param string $key
     * @param int $value
     * @return bool|int
     */
    public static function increment($key, $value = 1)
    {
        if (self::$cache == null){
            return false;
        }

        return self::$cache->increment($key,$value);
    }

    /**
     * set the value decrement by key.
     * @param string $key
     * @param int $value
     * @return int|bool
     */
    public static function decrement($key, $value = 1)
    {
        if (self::$cache == null){
            return false;
        }

        return self::$cache->decrement($key,$value);
    }


}