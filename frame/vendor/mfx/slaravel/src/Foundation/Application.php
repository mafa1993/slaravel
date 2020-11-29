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
use Slaravel\Event\Event;
use Slaravel\Support\Facades\Facade;

class Application extends Container
{

    protected $basePath;
    //保存所有已经启动过的服务提供者，已经启动过的不重复启动
    protected $booted=false;
    //存储已经注册过的服务提供者
    public $serviceProviders;
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

        $this->registerBaseServicProvider();
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
            //'Route' => \Slaravel\Support\Facades\Route::class, //加载路由类
            'Route' => \Slaravel\Route\Router::class

        ];

        foreach ($binds as $name => $class){
            $this->bind($name,$class);
        }
       /* var_dump($this->bindings);
        $this->make('Route');*/
    }

    /**
     * 將配置文件中配置的服務提供者進行註冊
     */
    public function registerConfigProviders(){
        $providers = $this->make('Config')->get('app.providers');
        //在构造函数中将$this传入，获得App类
        (new ProviderRegistory($this))->load($providers);
    }

    /**
     * 对已经进行加载的服务提供者进行标记
     * @param string $provider
     */
    public function markAsRegistered($provider){
        $this->serviceProviders[] = $provider;
    }

    public function boot(){
        if($this->booted){
            return;
        }
        foreach ($this->serviceProviders as $provider){
            $provider->boot();
        }
        $this->booted=true;
    }

    /**
     *
     */
    public function registerBaseServicProvider(){
        //获取监听器
        $files = scandir($this->getBasePath().'/app/Listeners/');
        $event = new Event();

        foreach ($files as $file){
            if(in_array($file,['.','..'])){
                continue;
            }

            $class = 'App\\Listeners\\'.stristr($file,'.php',true);

            if(class_exists($class)){
                $listener = new $class($this);

                //监听器注册，注册的监听器名字，具体监听器类，以及执行的方法
                $event->listener($listener->getname(),[$listener,'handle']);
            }
        }

        $this->instance('event',$event);
    }
}