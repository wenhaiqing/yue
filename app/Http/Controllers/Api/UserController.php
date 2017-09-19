<?php
/**
 * Created by PhpStorm.
 * User: wenhaiqing
 * Date: 2017/9/18
 * Time: 16:00
 */

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(Request $request){

        return $request->user();
    }
}