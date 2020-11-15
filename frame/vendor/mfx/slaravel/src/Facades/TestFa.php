<?php

namespace Slaravel\Facades;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/11/14 0014
 * Time: 21:29
 */

//用于门面的测试
class TestFa
{
    public function __construct()
    {
        echo __DIR__."\t".__CLASS__."\t".__LINE__.'TestFa 的 构造方法'.PHP_EOL;
    }
    public function test(){
        echo __DIR__."\t".__CLASS__."\t".__LINE__.'TestFa 下的 test方法'.PHP_EOL;
    }
}