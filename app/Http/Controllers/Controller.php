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

    /**
     * 从七牛删除图片
     * @author wenhaiqing
     * $file string 图片路径
     * @return bool
     */
    public function deleteqiniu($file){

        if ($file) {

            // 初始化
            $disk = QiniuStorage::disk('qiniu');

            $bool = $disk->delete($file);                      //删除文件;
            // 判断是否上传成功
            if ($bool) {
                return true;
            }
            return false;
        }
        return false;
    }
}
