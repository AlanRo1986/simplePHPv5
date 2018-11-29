<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/05/26 0026
 * Time: 15:26
 */

namespace App\System\BasicInterface;


interface FileProviderInterface
{
    /**
     * @param string $path
     * @param bool $lock
     * @return mixed|string
     */
    public function get($path,$lock = false) ;

    /**
     * update the file to append it.
     * @param string $path
     * @param string $content
     * @return mixed
     */
    public function put($path,$content) ;

    /**
     * save a new file.
     * @param string $path
     * @param string $content
     * @param bool $lock
     * @return mixed
     */
    public function save($path,$content,$lock = false) ;

    /**
     * delete a file.
     * @param string $path
     * @return mixed
     */
    public function remove($path) ;

    /**
     * @param string $path
     * @return bool
     */
    public function exist($path) ;
}