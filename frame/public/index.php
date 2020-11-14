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
var_dump($app);

//门面测试
\Slaravel\Support\Facades\FacadeTest::test();