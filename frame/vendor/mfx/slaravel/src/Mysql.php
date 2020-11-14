<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/11/10 0010
 * Time: 21:07
 */

namespace Slaravel;


use Slaravel\Contracts\DB\DB;

class Mysql implements DB
{
    public function test()
    {
        echo 'mysql 实现DB 接口的test方法';
    }
}