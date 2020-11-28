<?php

namespace App\Http;

use Slaravel\Foundation\Http\Kernel as HttpKernel;

//继承自HttpKernel，这里定义的middleware,可以再父类中调用
class Kernel extends HttpKernel
{

    protected $middleware = [
        MiddlewareFirst::class,
        MiddlewareSec::class
    ];



}