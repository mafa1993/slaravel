<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/11/14 0014
 * Time: 19:42
 */

namespace Slaravel\Support\Facades;


use Slaravel\Facades\TestFa;

class FacadeTest extends Facade
{
    public static function getFacadeAccessor()
    {
        return TestFa::class;
    }
}