<?php
/**
 * Created by PhpStorm.
 * User: Alan 341455770@qq.com
 * Date: 2017/05/18 0018
 * Time: 17:57
 */

if (!defined("APP")) die("Access failed.");

use App\System\Basic\Application;
use App\System\Data\Cookie;
use App\System\Http\ResponseProvider;
use App\System\Http\RouteProvider;
use App\System\Template\TemplateProvider;
use App\System\Utils\DateTimeUtils;
use App\System\Utils\LocationUtils;
use App\System\Utils\TextUtils;

/**
 * Prevents access to $this/self from included files.
 * @param string $file
 * @throws Exception
 */
function includeFile($file)
{
    if (file_exists($file) === false){
        throw new \Exception("The file[".$file."] is not found.");
        return;
    }
    include $file;
}

/**
 * return a new instance.
 * @param string $abstract
 * @param array $args
 * @return mixed|Application|object|*
 */
function app($abstract = ""){
    $args = func_get_args();
    if(count($args) > 0 && $args[0] == $abstract){
        array_shift($args);

    }

    if (!$abstract){
        return Application::newInstance(ROOT_PATH);
    }
    return Application::newInstance(ROOT_PATH)->make($abstract,$args);
}

/**
 * get unix time.
 * @return int
 */
function getTime() {
    return DateTimeUtils::getTime();
}

/**
 * @param int $time
 * @param string $format
 * @return string
 */
function formatTime($time,$format = DateTimeUtils::DATETIME_FULL_QUOTE){
    return DateTimeUtils::formatTime($time,$format);
}

/**
 * @param string $str
 * @return int
 */
function timeSpanFormat($str){
    return DateTimeUtils::strToTime($str);
}

/**
 * @return string
 */
function getClientIp(){
    return LocationUtils::getIP();
}

function getDomain(){
    /* 协议 */
    $protocol = getHttp();
    $host = '';
    /* 域名或IP地址 */
    if (isset ($_SERVER ['HTTP_X_FORWARDED_HOST'])) {
        $host = $_SERVER ['HTTP_X_FORWARDED_HOST'];
    } elseif (isset ($_SERVER ['HTTP_HOST'])) {
        $host = $_SERVER ['HTTP_HOST'];
    } else {
        /* 端口 */
        if (isset ($_SERVER ['SERVER_PORT'])) {
            $port = ':' . $_SERVER ['SERVER_PORT'];

            if ((':80' == $port && 'http://' == $protocol) || (':443' == $port && 'https://' == $protocol)) {
                $port = '';
            }
        } else {
            $port = '';
        }

        if (isset ($_SERVER ['SERVER_NAME'])) {
            $host = $_SERVER ['SERVER_NAME'] . $port;
        } elseif (isset ($_SERVER ['SERVER_ADDR'])) {
            $host = $_SERVER ['SERVER_ADDR'] . $port;
        }
    }

    return $protocol . $host;
}

/**
 * @return string
 */
function getHttp(){
    return (isset ($_SERVER ['HTTPS']) && (strtolower($_SERVER ['HTTPS']) != 'off')) ? 'https://' : 'http://';
}

/**
 * get const configuration.
 * @param string $key
 * @param string $val
 * @return array|string
 */
function conf($key,$val){
    return app()->getConfigs(TextUtils::lower($key),$val);
}

/**
 * get locale by key.
 * @param string $key
 * @return string
 */
function lang($key) {
    return app()->getLocales($key);
}

/**
 * send response.
 * @param array $data
 * @param int $code
 */
function output($data,$code = ResponseProvider::HTTP_OK){

    $route = app(RouteProvider::class);

    $data['Controller'] = $route->getController();
    $data['Action'] = $route->getAction();
    $data['Version'] = $route->getVersionCode();

    $response = app(ResponseProvider::class);
    $response->send($data,$code,ResponseProvider::RESPONSE_TYPE_JSON);
}

/**
 * send response header
 * @param string $key
 * @param string $val
 */
function outputHeader($key,$val){
    $response = app(ResponseProvider::class);
    $response->setHeader($key,$val);
}

/**
 * send response headers,replace all array.
 * @param array $headers
 */
function outputHeaders($headers){
    if (empty($headers) == false){
        $response = app(ResponseProvider::class);
        $response->setHeaders($headers);
    }
}

/**
 * Cookie::newInstance()->setKey("test")->setValue("testValue")
 * Cookie::newInstance()->setKey("test")->setValue("testValue")->setPath("/")->setExpire(3500)->setDomain("")
 *
 * @param Cookie $cookie
 */
function outputCookie($cookie){
    $response = app(ResponseProvider::class);
    $response->setCookie($cookie);
}

/**
 * Template output the html.
 * @param string $fileName
 */
function display($fileName = "init.html"){
    $tmpl = app(TemplateProvider::class);
    $tmpl->display($fileName);
}

/**
 * Template assign the variable.
 * @param string $key
 * @param $value
 */
function assign($key,$value){
    $tmpl = app(TemplateProvider::class);
    $tmpl->assign($key,$value);
}