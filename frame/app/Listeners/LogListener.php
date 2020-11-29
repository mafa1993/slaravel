<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/11/28 0028
 * Time: 19:57
 */

namespace App\Listeners;

use Slaravel\Event\Listener;
use Slaravel\Foundation\Application;

class LogListener extends Listener
{

    protected $name = 'log';

    public function handle()
    {
        echo '记录日志';
    }
}