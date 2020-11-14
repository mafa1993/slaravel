<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/11/14 0014
 * Time: 16:05
 */

namespace Slaravel\Foundation;


use Slaravel\Container\Container;

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