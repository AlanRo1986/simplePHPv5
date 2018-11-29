<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/05/22 0022
 * Time: 15:16
 */

namespace App\System\BasicInterface;


interface CacheInterface
{
    /**
     * initialize the class.
     * @return mixed
     */
    public function init();

    /**
     * determine this key exist or not.
     * @param string $key
     * @return bool
     */
    public function exist($key);

    /**
     * get value by key.
     * @param string $key
     * @return mixed
     */
    public function get($key);

    /**
     * set value by key.
     * @param string $key
     * @param $val
     * @return bool
     */
    public function set($key,$val);

    /**
     * delete a key.
     * @param string $key
     * @return bool
     */
    public function remove($key);

    /**
     * clear all the keys.
     * @return bool
     */
    public function destroy();

}