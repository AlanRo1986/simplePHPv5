<?php
/**
 * Created by PhpStorm.
 * User: Alan 341455770@qq.com
 * Date: 2017/05/22 0022
 * Time: 11:24
 */

namespace App\System\Storage;

use App\System\Basic\Provider;
use App\System\BasicInterface\StoreInterface;

class CookieProvider extends Provider implements StoreInterface
{
    protected static $cookiePath = "";
    protected static $cookieDomain = "";
    protected static $cookieExpire = 0;

    public function __construct(){
        parent::__construct();
    }

    /**
     * The first run the middleware.
     * @return mixed
     */
    public function middleware()
    {
        // TODO: Implement middleware() method.
    }

    /**
     * @throws \Exception
     */
    public function register()
    {
        // TODO: Implement register() method.

        self::setCookieDomain(conf("cookies","cookieDomain"));
        self::setCookiePath(conf("cookies","cookiePath"));
        self::setCookieExpire(conf("cookies","cookieExpire") + TIME_UTC);
    }

    /**
     * determine this key exist or not.
     * @param string $key
     * @return bool
     */
    public static function exist($key)
    {
        // TODO: Implement exist() method.
        return isset($_COOKIE[$key]);
    }

    /**
     * get value by key.
     * @param string $key
     * @return mixed
     */
    public static function get($key)
    {
        // TODO: Implement get() method.

        $val = $_COOKIE[$key];

        if (empty($val)){
            $val = null;
        }
        return $val;
    }

    /**
     * set value by key.
     * @param string $key
     * @param $val
     * @param int $expire
     * @return bool
     */
    public static function set($key, $val,$expire)
    {
        // TODO: Implement set() method.
        if (empty($expire) == true){
            $expire = static::$cookieExpire;
        }else{
            $expire = TIME_UTC + $expire;
        }
        return self::save($key,$val,$expire,static::$cookiePath,static::$cookieDomain);
    }

    /**
     * delete a key.
     * @param string $key
     * @return bool
     */
    public static function remove($key)
    {
        // TODO: Implement remove() method.
        return self::save($key,'',0);
    }

    /**
     * clear all the keys.
     * @return bool
     */
    public static function destroy()
    {
        // TODO: Implement destroy() method.
        unset($_COOKIE);
        return true;
    }


    /**
     * save cookie.
     * @param string $key
     * @param string $val
     * @param int $expire
     * @param string $path
     * @param string $domain
     * @return true
     */
    public static function save($key,$val,$expire = 0,$path = '/',$domain = '') {
        return setcookie($key, $val, $expire, $path, $domain);
    }


    /**
     * @param string $cookieDomain
     */
    protected static function setCookieDomain($cookieDomain)
    {
        self::$cookieDomain = $cookieDomain;
    }

    /**
     * @param int $cookieExpire
     */
    protected static function setCookieExpire($cookieExpire)
    {
        self::$cookieExpire = $cookieExpire;
    }

    /**
     * @param string $cookiePath
     */
    protected static function setCookiePath($cookiePath)
    {
        self::$cookiePath = $cookiePath;
    }

    /**
     * @return string
     */
    public static function getCookiePath()
    {
        return self::$cookiePath;
    }

    /**
     * @return string
     */
    public static function getCookieDomain()
    {
        return self::$cookieDomain;
    }

    /**
     * @return int
     */
    public static function getCookieExpire()
    {
        return self::$cookieExpire;
    }

}