<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/11/28 0028
 * Time: 20:11
 */
//用于事件存储
namespace Slaravel\Event;


class Event
{
    protected $listener; //如果多个监听器，只会记录最后一个
    protected $events; //记录所有

    public function listener($listener,$callback){

        $this->listener = strtolower($listener);
        $this->events[$listener] = [$callback];
    }


    /**
     * 分发执行
     * @param $listener
     * @param array $param
     * @return bool
     */
    public function dispatch($listener,$param = []){
        $listener = strtolower($listener);
        if($this->events[$listener]){
            ($this->events[$listener][0])(...$param);
            return true;
        }
    }

}