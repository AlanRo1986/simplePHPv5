<?php

/**
 * example:
 * $cookie = Cookie::newInstance()
 * ->setDomain("www.test.com")
 * ->setExpire(3600*24)
 * ->setPath("/root/")
 * ->setKey("id")
 * ->setValue(10);
 *
 *
 * Created by PhpStorm.
 * User: Alan 341455770@qq.com
 * Date: 2017/5/24 0024
 * Time: 18:34
 */

namespace App\System\Data;

class Cookie
{
    protected $key;
    protected $value;
    protected $expire;
    protected $path;
    protected $domain;

    public function __construct()
    {

        $this->setExpire(conf("cookies","cookieExpire"));
        $this->setPath(conf("cookies","cookiePath"));
        $this->setDomain(conf("cookies","cookieDomain"));
    }

    public static function newInstance(){
        return new Cookie();
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.

        return $this->getKey().":".$this->getValue();
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getExpire()
    {
        return $this->expire;
    }

    /**
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $domain
     * @return $this
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * @param mixed $expire
     * @return $this
     */
    public function setExpire($expire)
    {
        $this->expire = $expire + TIME_UTC;
        return $this;
    }

    /**
     * @param string $key
     * @return $this
     */
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @param string $path
     * @return $this
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }


}