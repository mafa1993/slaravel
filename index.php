<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/11/8 0008
 * Time: 21:22
 */

use Slaravel\Test;
//引入自动加载文件
require_once  'vendor/autoload.php';
//$a = new Test();

$ioc = new \Slaravel\Container\Container();
//$ioc->bind('test',Test::class);
//$ioc->getBind();
$ioc->singleton('test',Test::class);
//解析容器里的类
var_dump($ioc->make('test'));
var_dump($ioc->make('test'));