<?php

namespace Slaravel\Route;

use Slaravel\Foundation\Application;

class Router
{
    protected $routes = [];
    protected $verbs = ['GET','POST','PUT'];
    protected $action;
    protected $namespace;
    protected $controller;
    protected $app;

    public function __construct(Application $app)
    {
        //用于app的注入
        $this->app = $app;
    }

    public function get($uri,$action){
        $this->addRoute(['GET'],$uri,$action);
    }

    public function any($uri,$action){
        $this->addRoute($this->verbs,$uri,$action);
    }


    /**
     * @param array $method any会传递多个
     * @param $uri
     * @param $action
     */
    protected function addRoute($method,$uri,$action){
        foreach ($method as $v){
            $this->routes[$v][$uri] = $action;
        }
    }

    public function getRoutes(){
        var_dump('get Route');
        return $this->routes;
    }

    /**
     * 获取路由文件路径
     * @param $route_path
     */
    public function register($route_path){
        //因为门面传参是[...$arguments]
        echo 'router register   ';
        require_once("$route_path");
    }

    /**
     * 对路由进行匹配执行
     * @param $request
     */
    public function dispatcher($request){
        //匹配路由
        $this->findRoute($request);
        //执行路由
        $this->runRoute($request);
    }

    /**
     * 查找路由
     * @param $request
     */
    public function findRoute($request){
        //路由查找 请求方式和uri
        $this->match($request->getMethod(),$request->getUri());

    }

    /**
     * 获取匹配的路由规则
     */
    protected function match($method,$path){
        $routes = $this->routes;
        foreach ($routes[$method] as $uri=>$route){
            if(trim($uri,'/') == trim($path,'/')){
                $this->action = $route;
                break;
            }
        }
        return $this;
    }

    /**
     * 执行路由
     * @param $request
     */
    public function runRoute($request){
        //测试匹配路由是否成功
        //var_dump($this->action);
        if($this->action instanceof \Closure){
            //如果是闭包直接执行
            ($this->action)();
        }

        //如果是字符串，这里只对Controller的类型进行处理
        if(is_string($this->action)){
            $this->runController();
        }
    }


    /**
     * 执行控制器方法
     */
    protected function runController(){
        $class = $this->getController();
        $method = $this->getMethod();
        //执行对应的控制器方法
        $class->$method();
    }

    protected function getController(){
        if (!$this->controller){
            $class = $this->namespace.'\\'.explode('@',$this->action)[0];

            $this->controller = $this->app->make(ltrim($class,'\\'));
        }

        return $this->controller;
    }

    protected function getMethod(){
        return explode('@',$this->action)[1];
    }

    /**
     * 设置控制器的命名空间，在Route的服务提供者中调用进行配置
     * @param $namespace
     * @return $this
     */
    public function setNamespace($namespace){
        $this->namespace = $namespace;
        return $this;
    }



}