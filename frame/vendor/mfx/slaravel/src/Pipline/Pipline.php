<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/11/28 0028
 * Time: 16:39
 */

namespace Slaravel\Pipline;

class Pipline
{

    protected $pipes;
    protected $passable;
    protected $app;
    protected $method = 'handle';

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function then(\Closure $closure){
        $res = array_reduce(
            $this->pipes,  //所有需要执行的中间件
            $this->carry(),
            $closure
        );
        return $res($this->passable);
    }

    public function carry(){
        return function ($stack,$pipe){
            return function ($passable)use($stack,$pipe){
                if(is_callable($pipe)){
                    return $pipe($passable,$stack);
                }elseif(!is_object($pipe)){
                    //类先实例化
                    $pipe = $this->app->make($pipe);
                    $params = [$passable,$stack];
                }
                return method_exists($pipe,$this->method) ? $pipe->{$this->method}(...$params) : $pipe(...$params);  //默认执行中间件的handle方法

            };
        };
    }

/*array_reduce(
$this->pipes,  //所有需要执行的中间件
    function ($passable)use($stack,$pipe){

                return $pipe($passable,$stack);
             //默认执行中间件的handle方法

        ;
    },
$closure
);
    1. $res = mid1::hadle($passable,$con)
    2. $res = mid2::hadle($passable,$res())*/


    /**
     * 用来获取中间件
     * @param $pipes
     * @return object
     */
    public function through($pipes){
        $this->pipes = $pipes;
        return $this;
    }

    /**
     * @param $passable
     * @return object
     */
    public function send($passable){
        $this->passable = $passable;
        return $this;
    }





}