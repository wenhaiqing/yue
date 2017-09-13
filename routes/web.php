<?php

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

    $router->get('setting/{lang}', 'SettingController@language');


});