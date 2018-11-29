<?php
/**
 * Created by PhpStorm.
 * User: Alan 341455770@qq.com
 * Date: 2017/05/22 0022
 * Time: 10:55
 */

namespace App\System\Storage;


use App\System\Basic\Provider;
use App\System\BasicInterface\StoreInterface;

class SessionProvider extends Provider implements StoreInterface
{
    protected static $authKey = "";

    protected static $sessionExpire = 0;
    protected static $sessionPath = "";

    public function __construct()
    {
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
     * instance register.
     */
    public function register()
    {
        // TODO: Implement register() method.


        self::setAuthKey(conf("app","authToken"));
        self::setSessionExpire(conf("session","sessionExpire"));
        self::setSessionPath(conf("session","sessionPath"));

        self::start();
    }

    /**
     * return the session id.
     * @return string
     */
    public static function getSessionId()
    {
        return session_id();
    }

    /**
     * start the session.
     */
    public static function start()
    {
        session_set_cookie_params(0,CookieProvider::getCookiePath(),CookieProvider::getCookieDomain());
        session_save_path(self::getBasePath().self::getSessionPath());

        @session_start();
    }

    /**
     * close the session.
     */
    public static function close(){
        @session_write_close();
    }

    /**
     * return the session is expire or not.
     * @return bool
     */
    public static function isExpire() {
        if (self::exist("expire") && (int)self::get("expire") < TIME_UTC) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * set expire time.
     * @return bool
     */
    public static function setExpire() {
        return self::set("expire",TIME_UTC + self::getSessionExpire());
    }

    /**
     * determine this key exist or not.
     * @param string $key
     * @return bool
     */
    public static function exist($key)
    {
        // TODO: Implement exist() method.

        return isset($_SESSION[self::getEncryptKey($key)]);
    }

    /**
     * get value by key.
     * @param string $key
     * @return mixed
     */
    public static function get($key)
    {
        // TODO: Implement get() method.

        $val = $_SESSION[self::getEncryptKey($key)];

        if (empty($val)){
            return null;
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
    public static function set($key, $val,$expire = 0)
    {
        // TODO: Implement set() method.

        $_SESSION[self::getEncryptKey($key)] = $val;

        return true;
    }

    /**
     * delete a key.
     * @param string $key
     * @return bool
     */
    public static function remove($key)
    {
        // TODO: Implement remove() method.
        unset($_SESSION[self::getEncryptKey($key)]);
        return true;
    }

    /**
     * clear all the keys.
     * @return bool
     */
    public static function destroy()
    {
        // TODO: Implement destroy() method.

        return session_destroy();
    }

    /**
     * return auth&key.
     * @param string $key
     * @return string
     */
    protected static function getEncryptKey($key) {
        return self::getAuthKey()."_".$key;
    }

    /**
     * @param string $authKey
     */
    protected static function setAuthKey($authKey)
    {
        self::$authKey = $authKey;
    }

    /**
     * @param int $sessionExpire
     */
    protected static function setSessionExpire($sessionExpire)
    {
        self::$sessionExpire = $sessionExpire;
    }

    /**
     * @param string $sessionPath
     */
    protected static function setSessionPath($sessionPath)
    {
        self::$sessionPath = $sessionPath;
    }

    /**
     * @return string
     */
    public static function getAuthKey()
    {
        return self::$authKey;
    }

    /**
     * @return int
     */
    public static function getSessionExpire()
    {
        return self::$sessionExpire;
    }

    /**
     * @return string
     */
    public static function getSessionPath()
    {
        return self::$sessionPath;
    }


}