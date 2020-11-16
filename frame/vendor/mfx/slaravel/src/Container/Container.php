<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/11/9 0009
 * Time: 20:43
 */

namespace Slaravel\Container;

// 容器，主要用于存储服务
// 主要包含两个方法，bind和make
class Container implements \ArrayAccess
{
    //容器绑定后存储在数组中
    protected $bindings = [];

    //存储共享容易，即使用singleton 绑定的实例
    protected $instances = [];

    /**
     * 注入，简单绑定实现
     * @param string $abstract 标识，绑定后的类名
     * @param mixed $concrete 对象或者回调，具体绑定那个对象，可以使回调，必报，字符串
     * @param bool $shared
     */
    public function bind($abstract,$concrete = null,$shared = false){
        //将对象存储起来，即为绑定，使用时在数组种查找
        //$this->bindings[$abstract] = $concrete;
        $this->bindings[$abstract]['shared'] = $shared;
        $this->bindings[$abstract]['concrete'] = $concrete;
    }

    /**
     *
     */
    public function getBind(){
        var_dump($this->bindings);
    }

    /**
     * 根据标识，将容器中对应的类解析出来使用，即为创建对象
     * @param string $abstract 标识
     * @param array $arguments 创建对象时的参数
     * @return Object
     */
    public function make($abstract,$arguments = [])
    {
        /* //门面也是使用make进行类的解析，并没有传递标识，直接传递的对象，所以这里去除判断
         * //判断标识是否存在
        if(!isset($this->bindings[$abstract]) and !isset($this->instances[$abstract])){
            exit('标识不存在，没有进行注册');
        }*/

        //判断是否是单利注册,即在instances是否存在
        if($this->instances[$abstract]){
            return $this->instances[$abstract];
        }

        $obj = $this->getConrete($abstract);

        //$obj = $this->bindings[$abstract]['concrete'];
        //判断是否是闭包, Closure为闭包
        if ($obj instanceof \Closure){
            $obj =  $obj();
        }

        if (!is_object($obj)){
            $obj = new $obj(...$arguments);
        }


        if($this->bindings[$abstract]['shared']){
            $this->instances[$abstract] = $obj;
        }

        return $obj;
    }

    /**
     * 只实例化一次
     * @param string $abstract 标识，绑定后的类名
     * @param mixed $concrete 对象或者回调，具体绑定那个对象，可以使回调，必报，字符串
     * @param bool $shared
     */
    public function singleton($abstract,$concrete = null ,$shared = true){
        $this->bind($abstract,$concrete,$shared);
    }

    /**
     * 绑定实例到容器
     * @param $abstract string 标识
     * @param $instance object 实例化后的对象
     */
    public function instance($abstract,$instance){
        //将bindings中的清除，instances中存在的话，防止在bindings中还存了一份
        $this->removeBindings($abstract);
        $this->instances[$abstract] = $instance;

        //测试app是否成功注册
        //var_dump($this->instances);
    }

    /**
     * 清除绑定的容器
     * @param string $abstract 要清除的标识
     */
    public function removeBindings($abstract){
        if(isset($this->bindings[$abstract])){
            unset($this->bindings[$abstract]);
        }
    }


    /**
     * @param mixed $abstract 标识或者对象
     * @return object
     */
    public function getConrete($abstract){
        if(isset($this->bindings[$abstract])){
            return $this->bindings[$abstract]['concrete'];
        }

        return $abstract;

    }


    /**
     * 对象当做数组判断时触发
     * @param mixed $offset
     */
    public function offsetExists($offset)
    {
        echo '1';
        // TODO: Implement offsetExists() method.
    }

    /**
     * 对象当做数组获取触发，使用数组调用时，也可以解析类
     * @param mixed $offset
     */
    public function offsetGet($offset)
    {
        return $this->make($offset);
    }

    /**
     * 把对象当做数组设置时
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        // TODO: Implement offsetSet() method.
    }

    /**
     * 对象当做数组unset时触发
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        // TODO: Implement offsetUnset() method.
    }

}