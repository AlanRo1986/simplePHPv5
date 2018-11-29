<?php
/**
 * Created by PhpStorm.
 * User: Alan 341455770@qq.com
 * Date: 2017/05/24 0024
 * Time: 10:33
 */

namespace App\System\BasicInterface;


use App\System\Utils\TextUtils;

trait Router
{
    protected $id = 0;
    protected $controllerFile = "";
    protected $controller = "Init";
    protected $ctl = "Init";
    protected $action = "get";
    protected $method = "get";
    protected $versionName = "v1";
    protected $versionCode = 1;
    protected $app = "app";

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return string
     */
    public function getController()
    {
        return "App\\Controller\\".$this->controller;
    }

    /**
     * @return string
     */
    public function getCtl()
    {
        return $this->ctl;
    }

    /**
     * @param string $ctl
     */
    public function setCtl($ctl)
    {
        $this->ctl = $ctl;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return int
     */
    public function getVersionCode()
    {
        return $this->versionCode;
    }

    /**
     * @return string
     */
    public function getVersionName()
    {
        return $this->versionName;
    }

    /**
     * @param string $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * @param string $controller
     */
    public function setController($controller)
    {
        $this->controller = TextUtils::ucfirst($controller);
    }

    /**
     * @param string $controllerFile
     */
    public function setControllerFile($controllerFile)
    {
        $this->controllerFile = TextUtils::ucfirst($controllerFile);
    }

    /**
     * @return string
     */
    public function getControllerFile()
    {
        return $this->controllerFile;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * @param int $versionCode
     */
    public function setVersionCode($versionCode)
    {
        $this->versionCode = $versionCode;
    }

    /**
     * @param int $ver
     */
    public function setVersionName($ver)
    {
        $this->versionName = "v".$ver;
    }

    /**
     * @param string $appType
     */
    public function setApp($appType)
    {
        $this->app = $appType;
    }

    /**
     * @return string
     */
    public function getApp()
    {
        return $this->app;
    }

    /**
     * @return string
     */
    public function getControllerFilePath()
    {
        return TextUtils::lower($this->getControlExtra()."/".$this->getVersionName()."/").$this->getControllerFile();
    }


}