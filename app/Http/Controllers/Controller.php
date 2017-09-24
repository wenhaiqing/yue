<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use zgldh\QiniuStorage\QiniuStorage;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * 上传图片到七牛
     * @author wenhaiqing
     * @return bool
     */
    public function uploadqiniu($file){

        if ($file) {

            // 初始化
            $disk = QiniuStorage::disk('qiniu');
            // 重命名文件
            $fileName = md5($file->getClientOriginalName().time().rand()).'.'.$file->getClientOriginalExtension();
            // 上传到七牛
            $bool = $disk->put('wenhaiqing/image_'.$fileName,file_get_contents($file->getRealPath()));
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
