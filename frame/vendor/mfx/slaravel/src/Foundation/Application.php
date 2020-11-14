<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/11/14 0014
 * Time: 16:05
 */
//application 类

namespace Slaravel\Foundation;


use Slaravel\Container\Container;
use Slaravel\Support\Facades\Facade;

class Application extends Container
{

    protected $basePath;
    /**
     * Application constructor.
     * @param string $basePath 用于设置项目根目录
     */
    public function __construct($basePath = '')
    {
        if($basePath){
            $this->setBasePath($basePath);
        }

        $this->registerBaseBindings();
        //$this->register

        //给Facade注入application类，laravel中是封装在了服务中心, 在registerBaseServiders中
        Facade::setFacadeApplication($this);
    }

    /**
     * 设置根目录
     * @param string $basePath
     */
    public function setBasePath($basePath){
        //设置的路径不包含最后一个斜杠
        $this->basePath = rtrim($basePath,'\/');
    }

    /**
     * 绑定自己到容器
     */
    public function registerBaseBindings(){
        $this->instance('app',$this);
    }
}