<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/11/14 0014
 * Time: 17:51
 */

require_once  __DIR__.'/../vendor/autoload.php';

//初始化app，绑定根目录等
$app = new \Slaravel\Foundation\Application($_ENV['APP_BASE_PATH'] ?? dirname(__DIR__));
//var_dump($app);

$app->singleton('kernel',\App\Http\Kernel::class);

//在使用容器获取kernel类，并注入app（内部需要使用application类进行类的注入）
$kernel = $app->make('kernel',[$app]);
//使用kernel的handle方法，处理请求
$kernel->handle($request = null);
//


//门面测试
//\Slaravel\Support\Facades\FacadeTest::test();