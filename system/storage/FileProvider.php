<?php
/**
 * Created by PhpStorm.
 * User: Alan 341455770@qq.com
 * Date: 2017/05/23 0023
 * Time: 16:53
 */

namespace App\System\Storage;


use App\System\Basic\Provider;
use App\System\BasicInterface\FileProviderInterface;
use App\System\Handler\FileHandler;

class FileProvider extends Provider implements FileProviderInterface
{
    private $fileHandler = null;

    public function __construct()
    {
        parent::__construct();
    }

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
        $this->fileHandler = new FileHandler();
    }

    /**
     * @return FileHandler
     */
    protected function getFileHandler()
    {
        return $this->fileHandler;
    }

    /**
     * @param string $path
     * @param bool $lock
     * @return mixed|string
     */
    public function get($path,$lock = false)
    {
        // TODO: Implement get() method.

        return $this->getFileHandler()->get($path,$lock);
    }

    /**
     * update the file to append it.
     * @param string $path
     * @param string $content
     * @return mixed
     */
    public function put($path, $content)
    {
        // TODO: Implement put() method.
        return $this->getFileHandler()->append($path,$content);
    }

    /**
     * save a new file.
     * @param string $path
     * @param string $content
     * @param bool $lock
     * @return bool|mixed
     */
    public function save($path, $content,$lock = false)
    {
        // TODO: Implement save() method.
        return $this->getFileHandler()->put($path,$content,$lock);
    }

    /**
     * delete a file.
     * @param string $path
     * @return mixed
     */
    public function remove($path)
    {
        // TODO: Implement remove() method.
        return $this->getFileHandler()->delete($path);
    }

    /**
     * @param string $path
     * @return bool
     */
    public function exist($path)
    {
        // TODO: Implement exist() method.
        return $this->getFileHandler()->exists($path);
    }
}