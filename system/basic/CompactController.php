<?php
/**
 * Created by PhpStorm.
 * User: Alan 341455770@qq.com
 * Date: 2017/05/24 0024
 * Time: 15:29
 */

namespace App\System\Basic;


use App\System\Data\Cookie;
use App\System\Http\RequestProvider;
use App\System\Http\RouteProvider;

abstract class CompactController extends Compact
{
    protected $request;

    public function __construct($request)
    {
        parent::__construct();

        $this->setRequestProvider($request);
        $this->assign('title',conf('app','title'));
    }

    protected function display($fileName = null){
        if($fileName == null){
            $fileName = $this->getRoute()->getCtl();
        }
        display($fileName.".html");
    }

    protected function assign($key,$value){
        assign($key,$value);
    }

    /**
     * @param array $data
     * @param string $err
     * @param int $code
     */
    protected function output($data,$err = "",$code = 0){
        $data['responseError'] = $err;
        $data['responseCode'] = $code;
        output($data);
    }

    /**
     * @param string $key
     * @param string $val
     */
    protected function outputCookie($key,$val){
        outputCookie(Cookie::newInstance()->setKey($key)->setValue($val));
    }

    /**
     * @param string $key
     * @param string $val
     */
    protected function outputHeader($key,$val){
        outputHeader($key,$val);
    }

    /**
     * @param array $headers
     */
    protected function outputHeaders($headers){
        outputHeaders($headers);
    }

    /**
     * @param RequestProvider $request
     */
    protected function setRequestProvider($request)
    {
        $this->request = $request;
    }

    /**
     * @return RequestProvider
     */
    protected function getRequestProvider()
    {
        return $this->request;
    }

    /**
     * @return array
     */
    protected function getRequest() {
        return $this->getRequestProvider()->getRequest();
    }

    /**
     * @return RouteProvider
     */
    protected function getRoute() {
        return app(RouteProvider::class);
    }


}