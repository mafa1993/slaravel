<?php

namespace Slaravel\Route;

class Router
{
    protected $routes = [];
    protected $verbs = ['GET','POST','PUT'];

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
        require_once("$route_path[0]");
    }
}