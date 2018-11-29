<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/05/26 0026
 * Time: 12:57
 */

namespace App\System\Handler;


use App\System\BasicInterface\QueueRedisInterface;

class SyncQueueHandler implements QueueRedisInterface
{

    public function size($key)
    {
        // TODO: Implement size() method.
        return false;
    }

    public function index($key,$index = 0)
    {
        // TODO: Implement index() method.
        return false;
    }

    public function push($key, $data)
    {
        // TODO: Implement push() method.
        return false;
    }

    public function last($key, $data)
    {
        // TODO: Implement last() method.
        return false;
    }

    public function pop($key)
    {
        // TODO: Implement pop() method.
        return false;
    }

    public function shift($key)
    {
        // TODO: Implement shift() method.
        return false;
    }

    public function connect()
    {
        // TODO: Implement connect() method.
        return false;
    }

    public function disconnect()
    {
        // TODO: Implement disconnect() method.
        return false;
    }

    /**
     * last push a object.
     * @param string $key
     * @param $data
     * @return mixed
     */
    public function first($key, $data)
    {
        // TODO: Implement first() method.
        return false;
    }
}