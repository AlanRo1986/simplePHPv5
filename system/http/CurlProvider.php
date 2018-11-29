<?php
/**
 * Created by PhpStorm.
 * User: Alan 341455770@qq.com
 * Date: 2017/05/31 0031
 * Time: 13:55
 *
 *
 * example:
 * $curl = app(CurlProvider::class);
 * $res = $curl->get("http://test.com/1.php");
 * $res = $curl->post("http://test.com/1.php");
 *
 * var_dump(json_decode($res,true));
 *
 */

namespace App\System\Http;


use App\System\Basic\Provider;
use App\System\Handler\CurlHandler;

class CurlProvider extends Provider
{
    protected $curl = null;

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

    }

    public function get($url,$data = []){
        return $this->getCurl()->get($url,$data);
    }

    public function post($url,$data = []){
        return $this->getCurl()->post($url,$data);
    }

    public function put($url,$data = []){
        return $this->getCurl()->put($url,$data);
    }

    public function delete($url,$data = []){
        return $this->getCurl()->delete($url,$data);
    }

    /**
     * @return CurlHandler
     */
    public function getCurl()
    {
        if ($this->curl == null){
            $this->curl = new CurlHandler();
        }
        return $this->curl;
    }

}