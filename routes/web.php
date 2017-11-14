<?php

use Illuminate\Support\Facades\Redis;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/socket',function(){
    $data = [
        'name' => 'event',
        'data' => [
            'name' => 'jelly',
        ],
    ];
    Redis::publish('test-channel',json_encode($data));
    return view('socket');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix' => 'admin','namespace' => 'Admin', 'middleware' => ['auth', 'check.permission', 'language']],function ($router)
{
    $router->get('/','HomeController@index');

    // 权限
    // require(__DIR__ . '/admin/permission.php');
    $router->resource('permission','PermissionController');
    // 角色
    $router->resource('role','RoleController');
    // 用户
    $router->resource('user','UserController');
    // 菜单
    $router->get('menu/clear','MenuController@cacheClear');
    $router->resource('menu','MenuController');
    //分类
    $router->get('category/clear','CategoryController@cacheClear');
    $router->get('category/addnorm','CategoryController@addnorm');
    $router->post('category/addnormstore','CategoryController@addnormstore');
    $router->resource('category','CategoryController');

    //首页幻灯片
    $router->get('slide/clear','SlideController@cacheClear');
    $router->resource('slide','SlideController');
    //首页头条
    $router->get('topline/clear','ToplineController@cacheClear');
    $router->resource('topline','ToplineController');
    //技师
    $router->resource('skiller','SkillerController');
    //需求
    $router->resource('demand','DemandController');

    $router->get('setting/{lang}', 'SettingController@language');


});
