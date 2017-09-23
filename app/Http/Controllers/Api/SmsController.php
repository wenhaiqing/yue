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
use Overtrue\EasySms\EasySms;
use Carbon\Carbon;
use Cache;
class SmsController extends Controller
{
    public function index(Request $request)
    {
        $arr = $request->all();
        $easySms = new EasySms(config('api.global.sms'));

    // 注册
        $easySms->extend('mygateway', function($gatewayConfig){
            // $gatewayConfig 来自配置文件里的 `gateways.mygateway`
            return new MyGateway($gatewayConfig);
        });
        $code = rand(1000,9999);
        $phone = $arr['phone'];
        $res = $easySms->send($phone, [
            'template' => config('api.global.alidayu.code_template'),
            'data' => [
                'verify' => "$code"
            ],
        ]);
        if($res['alidayu']['status'] == 'success'){
            $expiresAt = Carbon::now()->addMinutes(100);

            Cache::put($phone, $code, $expiresAt);
        }
        return response()->json($res['alidayu']);
    }
}