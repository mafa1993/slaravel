<?php

namespace Slaravel\Config;

//获取配置类
class Config
{
    public $items;
    /**
     * @param string $config_path config的路径
     * @return object
     */
    public function phpParser($config_path){
        $files = scandir($config_path);
        $data = [];
        foreach ($files as $file){
            if(in_array($file,['.','..'])){
                continue;
            }

            $filename = pathinfo($file)['filename'];
            $data[$filename] = require_once $config_path.DIRECTORY_SEPARATOR.$file;
        }

        $this->items = $data;

        return $this;
    }

    /**
     * 获取全部
     */
    public function all(){
        return $this->items;
    }

    /**
     * 获取具体配置
     * @param string $key 文件名.具体键
     */
    public function get($key){
        //利用变量，巧妙实现递归
        $data = $this->items;
        $key_arr = explode('.',$key);
        foreach ($key_arr as $val){
            $data = $data[$val];
        }
        return $data;
    }
}