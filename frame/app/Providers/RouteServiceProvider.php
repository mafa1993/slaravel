<?php

namespace App\Providers;

use Slaravel\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{

/*    public $bindings = [
        'test' =>
    ];*/

    public function register(){
        echo 'Route 服務提供者的 register'.PHP_EOL;
    }

    public function boot(){
        echo 'Route 服務提供者的 boot'.PHP_EOL;
    }

}