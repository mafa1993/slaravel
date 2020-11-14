<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/11/14 0014
 * Time: 19:38
 */
//门面类, 将类转换为静态调用
namespace Slaravel\Support\Facades;

class Facade
{
    //用于保存已经实例化过的门面，防止多次实例化
    protected static $resolvedInstance = [];
    protected static $app;

    /**
     * 静态调用找不到的方法时
     * @param $method
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($method, $arguments)
    {
        //创建实例
        //static 和 self区别： static如果是子调用，static代表子，self永远指向Facade
        $instance = static::getFacadeRoot();

        var_dump($method);
        return $instance->$method($arguments);

    }

    /**
     * 获取实例
     * @return mixed
     */
    public function getFacadeRoot(){
        //调用getFacadeAccessor获取子类重写的方法返回的要解析的类，进行实例化
        return static::resolveFacadeInstance(static::getFacadeAccessor());
    }

    public static function getFacadeAccessor(){}

    /**
     * 解析实例
     * @param mixed $obj
     * @return object
     */
    public static function resolveFacadeInstance($obj){
        if (is_object($obj)){
            return $obj;
        }

        if(isset(static::$resolvedInstance[$obj])){
            return static::$resolvedInstance[$obj];
        }
        //var_dump($obj);
        //门面也是使用容器的make方法进行解析
        return static::$resolvedInstance[$obj] = static::$app->make($obj);
    }


    /**
     * 注入application类到Facade类中
     * @param $app Slaravel\Foundation\Application
     */
    public static function setFacadeApplication($app){
        static::$app = $app;
    }

}