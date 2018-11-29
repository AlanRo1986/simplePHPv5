<?php
/**
 * Created by PhpStorm.
 * User: Alan 341455770@qq.com
 * Date: 2017/05/26 0026
 * Time: 14:39
 */

namespace App\System\BasicInterface;


interface FileHandlerInterface
{

    /**
     * @param string $path
     * @return bool
     */
    public function exists($path);

    /**
     * @param string $path
     * @param bool $lock
     * @return mixed
     */
    public function get($path,$lock = false);

    /**
     * @param string $path
     * @param string $content
     * @param bool $lock
     * @return mixed
     */
    public function put($path, $content, $lock = false);

    /**
     * @param string $path
     * @param string $content
     * @return mixed
     */
    public function prepend($path, $content);

    /**
     * @param string $path
     * @param string $content
     * @return mixed
     */
    public function append($path, $content);

    /**
     * @param string $path
     * @param null $mode
     * @return mixed
     */
    public function chmod($path, $mode = null);

    /**
     * @param $paths
     * @return mixed
     */
    public function delete($paths);

    /**
     * @param string $path
     * @param string $target
     * @return mixed
     */
    public function move($path,$target);

    /**
     * @param string $path
     * @param string $target
     * @return mixed
     */
    public function copy($path,$target);

    /**
     * @param string $path
     * @return mixed
     */
    public function name($path);

    /**
     * @param string $path
     * @return mixed
     */
    public function basename($path);

    /**
     * @param string $path
     * @return mixed
     */
    public function dirname($path);

    /**
     * @param string $path
     * @return mixed
     */
    public function extension($path);

    /**
     * @param string $path
     * @return mixed
     */
    public function type($path);

    /**
     * @param string $path
     * @return mixed
     */
    public function mimeType($path);

    /**
     * @param string $path
     * @return mixed
     */
    public function size($path);

    /**
     * @param string $path
     * @return mixed
     */
    public function lastModified($path);

    /**
     * @param string $path
     * @return mixed
     */
    public function isDirectory($path);

    /**
     * @param string $path
     * @return mixed
     */
    public function isReadable($path);

    /**
     * @param string $path
     * @return mixed
     */
    public function isWritable($path);

    /**
     * @param string $path
     * @return mixed
     */
    public function isFile($path);

    /**
     * @param string $pattern
     * @param int $flags
     * @return mixed
     */
    public function glob($pattern,$flags = 0);

    /**
     * @param string $directory
     * @return mixed
     */
    public function files($directory);

    /**
     * @param string $path
     * @param int $mode
     * @param bool $recursive
     * @param bool $force
     * @return mixed
     */
    public function makeDirectory($path, $mode = 0755, $recursive = false, $force = false);

    /**
     * @param string $from
     * @param string $to
     * @param bool $overwrite
     * @return mixed
     */
    public function moveDirectory($from, $to,$overwrite = false);

    /**
     * @param string $from
     * @param string $to
     * @param null $options
     * @return mixed
     */
    public function copyDirectory($from, $to, $options = null);

    /**
     * @param string $directory
     * @param bool $preserve
     * @return mixed
     */
    public function deleteDirectory($directory, $preserve = false);

    /**
     * @param string $directory
     * @return mixed
     */
    public function cleanDirectory($directory);

}