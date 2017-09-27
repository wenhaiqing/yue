<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use zgldh\QiniuStorage\QiniuStorage;
class BaseController extends Controller
{
    public function app_uploadqiniu($file){

        if ($file) {

            // 初始化
            $disk = QiniuStorage::disk('qiniu');
            // 重命名文件
            $file_type = pathinfo($file['name'], PATHINFO_EXTENSION);
            $fileName = md5($file['name'].time().rand()).'.'.$file_type;
            // 上传到七牛
            $bool = $disk->put('wenhaiqing/image_'.$fileName,file_get_contents($file['tmp_name']));
            // 判断是否上传成功
            if ($bool) {
                $path = $disk->downloadUrl('wenhaiqing/image_'.$fileName);
                return $path;
            }
            return false;
        }
        return false;
    }
}
