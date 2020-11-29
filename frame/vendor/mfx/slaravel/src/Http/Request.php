<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/11/21 0021
 * Time: 21:12
 */

namespace Slaravel\Http;

class Request
{
    //请求方式
    protected $method;
    //请求参数
    protected $uriPath;

    public static function capture(){
        $request = self::createBase();

        //请求方式
        $request->method = $_SERVER['REQUEST_METHOD'];
       // var_dump($_SERVER);

        //请求参数
        $request->uriPath = empty($_SERVER['PATH_INFO'])? $_SERVER['REQUEST_URI']:$_SERVER['PATH_INFO'];

        return $request;
    }


    /**
     * 创建自己的对象
     * @return static
     */
    public static function createBase(){
        //创建自己的静态对象
        return new static();
    }

    /**
     * 获取请求方法
     * @return mixed
     */
    public function getMethod(){
        return $this->method;
    }

    /**
     * 获取uri
     * @return mixed
     */
    public function getUri(){
        return $this->uriPath;
    }
}