<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['namespace' => 'Api', 'middleware' => ['auth:api']],function ($router)
{
    $router->post('/user','UserController@index');
    $router->post('/user/edit','UserController@edit');
    $router->post('/user/avatar','UserController@uploadavatar');
    $router->get('/topcategory','CategoryController@index');
    $router->post('/topcategory','CategoryController@getCategorySon');
    $router->post('/getcategoryware','CategoryController@getcategoryware');
    $router->post('/skiller/add','SkillerController@add');
    $router->post('/skiller/index','SkillerController@index');
    $router->post('/skiller/update','SkillerController@update');
    $router->post('/skiller/delete','SkillerController@delete');
    $router->post('/skiller/edit','SkillerController@edit');
    $router->post('/skiller/upload','SkillerController@upload');
    $router->post('/demand/add','DemandController@add');
    $router->post('/demand/index','DemandController@index');



});
Route::group(['namespace' => 'Api'],function ($router)
{
    $router->post('/sms','SmsController@index');
    $router->post('/register','RegisterController@index');
    $router->post('/login','RegisterController@login');
    $router->get('/home','HomeController@index');
    $router->post('/logout','RegisterController@logout');
    $router->post('/jpush','JpushController@index');
    $router->get('/test','HomeController@test');


});

