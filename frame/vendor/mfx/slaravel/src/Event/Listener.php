<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/11/28 0028
 * Time: 19:53
 */

namespace Slaravel\Event;
use Slaravel\Foundation\Application;

class Listener
{
    protected $name = 'listener';
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function handle(){}

    public function getname(){
        return $this->name;
    }

}