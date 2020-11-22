<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/11/21 0021
 * Time: 17:14
 */
use \Slaravel\Support\Facades\Route;


Route::get('admin',function (){
    echo 123;
});

Route::get('hello','Hello@index');