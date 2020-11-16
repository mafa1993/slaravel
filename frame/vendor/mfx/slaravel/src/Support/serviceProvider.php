<?php

namespace Slaravel\Support;

use Slaravel\Foundation\Application;

class serviceProvider
{
    protected $app;


    public function __construct(Application $app)
    {
        $this->app = $app;
    }


    public function register(){

    }

    public function boot(){

    }
}