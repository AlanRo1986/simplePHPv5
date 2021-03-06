<?php
/**
 * Created by PhpStorm.
 * User: Alan 341455770@qq.com
 * Date: 2017/05/18 0018
 * Time: 15:00
 */

namespace App\System;

use App\System\Basic\Application;
use App\System\Basic\AutoloaderDispatcher;
use App\System\Http\RouteProvider;
use App\System\Utils\TextUtils;

class AutoLoader
{
    const defaultNameSpaceFirst = "App";
    const defaultClassExtra = ".php";

    protected $basePath = "";
    protected $baseAutoloaderFiles = array();

    public function __construct($basePath)
    {
        $this->setBasePath($basePath);
    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        spl_autoload_unregister([$this,"loader"]);
    }

    /**
     * return static instance
     * @param string $path
     * @return AutoLoader
     */
    public static function newInstance($path){
        return new AutoLoader($path);
    }

    /**
     * auto loader.
     * @param $class
     */
    public function loader($class){
        includeFile($this->getFilePath($class));
    }

    /**
     * the auto loader first run this method.
     */
    public function run(){
        spl_autoload_register([$this,"loader"],true,true);
        $this->importer();
    }

    /**
     * initialize the auto loader class file arrays.
     */
    protected function importer()
    {
        $this->setBaseAutoloaderFiles(array_merge(AutoloaderDispatcher::getClass(),AutoloaderDispatcher::getInterface()));
    }

    /**
     * @param string $basePath
     */
    protected function setBasePath($basePath)
    {
        $this->basePath = $basePath;
    }

    /**
     * @return string
     */
    protected function getBasePath()
    {
        return $this->basePath;
    }

    /**
     * set the auto loader class array
     * @param array $baseAutoloaderFiles
     */
    protected function setBaseAutoloaderFiles($baseAutoloaderFiles)
    {
        $this->baseAutoloaderFiles = $baseAutoloaderFiles;
    }

    /**
     * return the defined autoLoader class array
     * @return array
     */
    protected function getBaseAutoloaderFiles()
    {
        return $this->baseAutoloaderFiles;
    }

    /**
     * return auto loader class file absolute path.
     * @param string $class
     * @return string
     * @throws \Exception
     */
    protected function getFilePath($class)
    {
//        if (strpos($class,"Controller\\") >= 0){
//           $filePath = $this->getControllerPath($class);
//        }else{
            $filePath = $this->getClassPath($class);
//        }

        if ($filePath == "" || file_exists($filePath) == false){

            if (!isset($this->getBaseAutoloaderFiles()[$class])){
                throw new \Exception("The class file[".$class."]\n[$filePath] is undefined.\nPlease define it to AutoloaderClass.php or AutoloaderInterface.php");
                return null;
            }
            return $this->getBasePath() . $this->getBaseAutoloaderFiles()[$class];
        }

        return $filePath;
    }

    /**
     * The nameSpace rule is App\DirectoryName(UcFirst)\FileName
     * App will changed ROOT_PATH
     * DirectoryName will changed ucfirst to lcfirst;
     * FileName is unaltered;
     * example: App\System\InitSystem -> d:/www/system/InitSystem.php
     * example: App\System\BaseInterFace\Compact -> d:/www/system\baseInterFace\Compact.php
     *
     * @param string $classStr
     * @return string
     */
    protected function getClassPath($classStr) {
        $filePath = "";
        $arr = explode("\\",$classStr);
        if (count($arr) == 0){
            return $filePath;
        }

        for ($i = 0;$i < count($arr);$i++){
            if ($i == 0 && $arr[$i] == self::defaultNameSpaceFirst){
                $filePath = $this->getBasePath();
            }elseif ($i == count($arr) - 1){
                $filePath .= $arr[$i].self::defaultClassExtra;
            }else{
                $filePath .= lcfirst($arr[$i]) . "/";
            }
        }

        return $filePath;
    }

    /**
     * The Controller namespace rule:
     * App/Controller/v1/InitController.php.
     * App:your appType directory.
     * Controller:directory
     * Version:request version code
     * InitController:Init is the Controller Name.
     *
     * @param string $class
     * @return string
     */
    protected function getControllerPath($class)
    {
        //D:/demo/app/controller/v1/InitController.php
        $path = app()->getInstance(RouteProvider::class)->getControllerFilePath();
        return $this->getBasePath().$path;
    }

}

