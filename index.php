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

//绑定契约（接口）
$ioc->singleton('test',Test::class);

/* //关于接口
 * class Mysql{
    public function select(){
        echo 'select';
    }
}
$db = new Mysql();

class Person{
    //这里约束的是Mysql类，如果后续改为使用sqlserver等，这个约束会导致错误，所以我们一般使用父类或者接口来当做约束
    public function query(Mysql $db){
        $db->select();
    }
}
$person = new Person();

$person->query($db);

//定义DB接口, 用于约束
interface DB{
    public function select();
}

class Oracle implements DB{
    public function select()
    {
        echo 'Oracle 实现select';
    }
}
$db = new Oracle();
//Person中的约束改为DB类约束
$person->query($db);
//implements 可以一次实现多个 class a implements B,C
*/

$ioc->bind(Slaravel\Contracts\DB\DB::class,\Slaravel\Mysql::class);



//解析容器里的类
var_dump($ioc->make('test'));
var_dump($ioc->make('test'));