<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/11/14 0014
 * Time: 19:42
 */

namespace Slaravel\Support\Facades;


use Slaravel\Route\Router;

class Route extends Facade
{
    public static function getFacadeAccessor()
    {
        echo 'route facades '.Router::class;
        return Router::class;
    }
}