<?php
/**
 * https://pecl.php.net/
 *
 *  example:
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
 * Date: 2017/05/23 0023
 * Time: 10:04
 */

namespace App\System\Handler;


use App\System\BasicInterface\CacheInterface;
use \Redis;

class CacheRedisHandler implements CacheInterface
{
    protected $option = [];
    protected $expiration = 0;

    protected $cache = false;
    protected $prefix = "";
    protected $redis;

    public function __construct($args)
    {
        $this->setCache(conf("cache","enabled"));
        $this->setOption(conf($args['driver'],""));
        $this->init();
    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
    }


    /**
     * initialize the class.
     */
    public function init()
    {
        // TODO: Implement init() method.
        if (count($this->getOption()) == 0){
            throw new \Exception("The [args] is params undefined.Please defined it in ConstantConfig:cache[redis].");
        }

        if (!class_exists("Redis")){
            throw new \Exception("Redis is disable.");
        }

        $this->setExpiration($this->option['expire']);
        $this->connect();
    }

    /**
     * connect the Redis.
     */
    protected function connect(){
        $this->setRedis(new Redis());
        $this->getRedis()->connect($this->option['host'],$this->option['port']);
    }

    /**
     * disconnect the Redis.
     */
    protected function disconnect(){
        $this->getRedis()->close();
    }

    /**
     * determine this key exist or not.
     * @param string $key
     * @return bool
     */
    public function exist($key)
    {
        // TODO: Implement exist() method.

        return $this->getRedis()->exists($key);
    }

    /**
     * get value by key.
     * @param string $key
     * @return mixed
     */
    public function get($key)
    {
        // TODO: Implement get() method.
        if ($this->getCache() == false){
            return false;
        }

        return $this->getRedis()->get($this->getKey($key));
    }

    /**
     * set value by key.
     * @param string $key
     * @param $val
     * @return bool
     */
    public function set($key, $val)
    {
        // TODO: Implement set() method.

        if ($this->getCache() == false){
            return false;
        }

        return $this->getRedis()->set($this->getKey($key), $val, $this->getExpiration());

    }

    /**
     * set the value increment by key.
     * @param string $key
     * @param int $value
     * @return int|bool
     */
    public function increment($key, $value = 1)
    {
        if ($this->getCache() == false){
            return -1;
        }

        return $this->getRedis()->incrBy($this->prefix.$key, $value);
    }

    /**
     * set the value decrement by key.
     * @param string $key
     * @param int $value
     * @return int|bool
     */
    public function decrement($key, $value = 1)
    {
        if ($this->getCache() == false){
            return -1;
        }

        return $this->getRedis()->decrBy($this->prefix.$key, $value);
    }

    /**
     * delete a key.
     * @param string $key
     * @return bool
     */
    public function remove($key)
    {
        // TODO: Implement remove() method.

        if ($this->getCache() == false){
            return false;
        }

        return $this->getRedis()->del($this->getPrefix().$key);
    }

    /**
     * clear all the keys.
     * @return bool
     */
    public function destroy()
    {
        // TODO: Implement destroy() method.

        if ($this->getCache() == false){
            return false;
        }

        return  $this->getRedis()->flushDB();
    }


    /**
     * @param array $option
     */
    public function setOption($option)
    {
        $this->option = $option;
    }

    /**
     * @return array
     */
    public function getOption()
    {
        return $this->option;
    }

    /**
     * @param string $prefix
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
    }

    /**
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @param int $expiration
     */
    public function setExpiration($expiration)
    {
        $this->expiration = TIME_UTC + $expiration;
    }

    /**
     * @return int
     */
    public function getExpiration()
    {
        return $this->expiration;
    }

    /**
     * @param boolean $cache
     */
    public function setCache($cache)
    {
        $this->cache = $cache;
    }

    /**
     * get the cache is enable or not.
     * @return bool
     */
    public function getCache(){
        return $this->cache;
    }

    /**
     * get the cache key(prefix.key).
     * @param string $key
     * @return string
     */
    public function getKey($key){
        return $this->getPrefix().$key;
    }

    /**
     * @param Redis $redis
     */
    public function setRedis($redis)
    {
        $this->redis = $redis;
    }

    /**
     * @Redis Redis
     */
    public function getRedis()
    {
        if ($this->redis == null){
            $this->redis = new Redis();
        }
        return $this->redis;
    }


}