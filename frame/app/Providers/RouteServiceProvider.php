<?php

namespace App\Providers;

use App\Http\Controller\Hello;
use Slaravel\Support\Facades\Route;
use Slaravel\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{

    protected $namespace='\App\Http\Controller';
/*    public $bindings = [
        'test' =>
    ];*/

    public function register(){
        echo 'Route 服務提供者的 register'.PHP_EOL;
        //app 类注入Router
        $this->app->instance('Route',$this->app->make('Route',[$this->app]));
    }

    public function boot(){
        echo 'Route 服務提供者的 boot'.PHP_EOL;
        //获取路由文件
        Route::setNamespace($this->namespace)->register($this->app->getBasePath().'/routes/routes.php');
    }

}