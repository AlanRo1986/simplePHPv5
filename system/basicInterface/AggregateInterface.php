<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/24 0024
 * Time: 19:08
 */

namespace App\System\BasicInterface;

interface AggregateInterface
{
    public function all();
    public function exist($key);
    public function set($key,$val);
    public function get($key);
    public function remove($key);
    public function has($key);
    public function destroy();
}