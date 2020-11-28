<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/11/23 0023
 * Time: 21:28
 */
namespace App\Http;

class MiddlewareSec
{
    public function handle($request,$next){
        echo 'MID 2 start'.PHP_EOL;
        $next($request);
        echo 'MID 2 end'.PHP_EOL;
    }
    
}