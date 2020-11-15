<?php
namespace Slaravel\Foundation\Bootstrap;

use Slaravel\Foundation\Application;

class LoadConfig
{
    public function bootstrap(Application $app){
        $config = $app->make('Config')->phpParser($app->getBasePath().DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR);
        //将解析完配置文件后Config类再重新注入
        $app->instance('Config',$config);
    }
}