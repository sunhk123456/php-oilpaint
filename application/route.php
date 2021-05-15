<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;
Route::resource('api/stayhome','admin/Stayhome');
//前台
Route::resource('api/index','index/Index2');
Route::resource('api/detail','index/Detail');
Route::resource('api/lists','index/Lists');
Route::resource('api/user','index/User');
Route::resource('api/login','index/Login');
Route::resource('api/collection','index/Collection');
Route::resource('api/orders','index/Orders');
return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],

];
