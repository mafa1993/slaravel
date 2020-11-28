<?php

namespace Slaravel\Foundation\Http;

//app/http/kernel的父类, 完成一些服务启动

use Slaravel\Foundation\Application;
use Slaravel\Pipline\Pipline;

class Kernel
{
    protected $bootstrappers = [
        \Slaravel\Foundation\Bootstrap\RegisterFacade::class,
        \Slaravel\Foundation\Bootstrap\LoadConfig::class,
        \Slaravel\Foundation\Bootstrap\RegisterProviders::class, //服务注册
        \Slaravel\Foundation\Bootstrap\BootProviders::class,  //服务提供者启动
    ];

    protected $app;
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * 请求处理
     * @param object $request
     */
    public function handle($request=null){
        //通过路由发送请求
        $this->sendRequestThroughRouter($request);
    }

    /**
     * 通过路由发送请求
     */
    public function sendRequestThroughRouter($request){
        //引导类启动
        $this->bootstrap();

        //請求綁定
        $this->app->instance('request',$request);

        //路由分发请求
        //$this->app->make('Route')->dispatcher($request);

        return (new Pipline($this->app))
            ->send($request)
            ->through($this->middleware)
            ->then($this->dispatchToRouter());

    }

    /**
     * 把中间件执行的结果封装成闭包
     * @return \Closure
     */
    public function dispatchToRouter(){
        return function ($request){
            $this->app->make('Route')->dispatcher($request);
        };
    }

    /**
     * 加载服务
     */
    public function bootstrap(){
        foreach ($this->bootstrappers as $bootstrapper){
            //使用容器获取每一项的实例，然后调用其的bootstrap方法
            $this->app->make($bootstrapper)->bootstrap($this->app);
        }
    }


}