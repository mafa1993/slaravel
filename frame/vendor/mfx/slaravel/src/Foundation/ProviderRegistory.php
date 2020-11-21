<?php
//用于服务加载
namespace Slaravel\Foundation;


class ProviderRegistory
{
    protected $app;
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * 服务提供者注册
     * @param array $providers
     */
    public function load($providers){
        foreach ($providers as $provider){
            $this->register($provider);
        }
    }

    /**
     * 根据不同类型进行分发 注册
     * @param string $provider 需要注册的服务
     */
    protected function register($provider){
        if(is_scalar($provider)){
            $provider = $this->resolveProvider($provider);
        }

        //利用resolve初始化以后，调用服务的register方法
        $provider->register();
        //服务提供者里可以定义bindings数组，进行一些类的绑定
        //属性如果存在进行绑定
        if(property_exists($provider,'bindings')){
            foreach ($provider->bindings as $key=>$val){
                $this->app->make($key,$val);
            }
        }

        //todo 单利绑定 singletons

        $this->app->markAsRegistered($provider);
    }


    /**
     * 服务提供者注测，核心方法
     */
    protected function resolveProvider($provider){
        return new $provider($this->app);
    }

}