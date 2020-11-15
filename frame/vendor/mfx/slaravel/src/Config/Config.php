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
            $data[$filename] = $file;
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
}