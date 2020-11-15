<?php

namespace Slaravel\Foundation\Http;

//app/http/kernel的父类, 完成一些服务启动

use Slaravel\Foundation\Application;

class Kernel
{
    protected $bootstrappers = [
        \Slaravel\Foundation\Bootstrap\RegisterFacade::class,
        \Slaravel\Foundation\Bootstrap\LoadConfig::class
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
        $this->sendRequestThroughRouter();
    }

    /**
     * 通过路由发送请求
     */
    public function sendRequestThroughRouter(){
        //引导类启动
        $this->bootstrap();
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