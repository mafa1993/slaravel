<?php

//中转类，ProviderRegistory是具体实现
//kernel中注册这个，这个调用app中的方法，app中在调用ProviderRegistory
namespace Slaravel\Foundation\Bootstrap;

use Slaravel\Foundation\Application;

class RegisterProviders
{



    public function bootstrap(Application $app){
        $app->registerConfigProviders();
    }
}