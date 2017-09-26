<?php
/**
 * Created by PhpStorm.
 * User: zdx
 * Date: 2017/9/23
 * Time: 15:22
 */
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\UserService;
use Cache;
use DB;
class RegisterController extends Controller
{
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }
    /*
     * APP注册方法
     */
    public function index(Request $request)
    {
        $arr = $request->all();
        $data['username'] = $arr['phone'];
        $data['password'] = $arr['password'];
        $result = $this->validatorcode($arr);
        if($result){
            $add = $this->service->apistore($data);
            if($add){
                $res['message'] = '新增成功';
                $res['status'] = '1';
            }else{
                $res['message'] = '手机号已注册过';
                $res['status'] = '0';
            }
        }else{
            $res['message'] = '验证码错误';
            $res['status'] = '0';
        }
        return response()->json($res);
    }
    /*
     * 验证短信验证码
     */
    public function validatorcode($res){
        $phone = $res['phone'];
        $code = Cache::get($phone);
        if($code == $res['code']){
            return true;
        }
    }

    public function login(Request $request){
        $res = $request->all();
        $http = new \GuzzleHttp\Client;
        $results = DB::select('select id,secret from yue_oauth_clients where name = :name', ['name' => 'Laravel Password Grant Client']);
        $response = $http->post('http://yue.zdxinfo.com/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => $results[0]->id,
                'client_secret' => $results[0]->secret,
                'phone' => $res['phone'],
                'password' => $res['password'],
                'scope' => '',
            ],
        ]);

        return json_decode((string) $response->getBody(), true);

    }
}