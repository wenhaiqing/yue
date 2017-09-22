<?php
/**
 * Created by PhpStorm.
 * User: zdx
 * Date: 2017/9/22
 * Time: 17:13
 */
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Overtrue\EasySms\EasySms;
class SmsController extends Controller
{
    public function index()
    {
        $easySms = new EasySms(config('admin.global.sms'));

    // 注册
        $easySms->extend('mygateway', function($gatewayConfig){
            // $gatewayConfig 来自配置文件里的 `gateways.mygateway`
            return new MyGateway($gatewayConfig);
        });

        $easySms->send(18635580539, [
            'content'  => '您的验证码为: 6379',
            'template' => 'SMS_12190065',
            'data' => [
                'name' => 6379
            ],
        ]);
    }
}