<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/11/23 0023
 * Time: 20:54
 */

//用于中间件测试

class MID1
{
    public function handle(Closure $next){
        echo '中间件1'.PHP_EOL;

        $next();
        echo '中间件1 end';
    }
}

class MID2
{
    public function handle(Closure $next){
        echo '中间件2'.PHP_EOL;

        $next();
        echo '中间件2 end';
    }
}


class con
{
    public function index(){
        echo 'con 方法';
    }
}

class Pipeline
{
    //用来保存需要执行的中间件
    protected $pipes = [
        MID1::class,
        MID2::class
    ];

    public function then(Closure $des){
        return array_reduce($this->pipes,function ($res,$pipe){
            return function ()use($res,$pipe){
                return $pipe::handle($res);
            };
        },$des);
    }
}

$con = function (){
  (new con)->index();
};
$pi = new Pipeline();
($pi->then($con))();

/**
 * des         res      pip
 * con函数
 *
 */

(function (){
    ECHO '中间2';
    function (){
        echo '中间1';
        $con();
        echo '中间1 end';;
    }
    ECHO '中间2 end';
})();
