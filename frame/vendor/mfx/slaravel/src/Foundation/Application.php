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

        //注册核心的容器别名
        $this->registerCoreContainerAliases();
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
     * 获取项目根路径
     * @return mixed
     */
    public function getBasePath(){
        return $this->basePath;
    }

    /**
     * 绑定自己到容器
     */
    public function registerBaseBindings(){
        $this->instance('app',$this);
    }

    /**
     * 核心容器绑定
     */
    public function registerCoreContainerAliases(){
        $binds = [
            'FacadeTest' => \Slaravel\Support\Facades\FacadeTest::class,
            'Config' => \Slaravel\Config\Config::class, //加载配置类

        ];

        foreach ($binds as $name => $class){
            $this->bind($name,$class);
        }
    }

    /**
     * 將配置文件中配置的服務提供者進行註冊
     */
    public function registerConfigProviders(){
        $providers = $this->make('Config')->get('app.providers');
    }


}