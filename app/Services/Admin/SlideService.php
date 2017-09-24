<?php
namespace App\Services\Admin;

use Facades\ {
    App\Repositories\Eloquent\SlideRepositoryEloquent,
    App\Repositories\Eloquent\PermissionRepositoryEloquent
};

use Exception;

class SlideService {


	
	/**
	 * 获取幻灯片并缓存
	 * @Author   wenhaiqing
	 * @DateTime 2017-07-31T21:42:12+0800
	 * @return   [type]                   [description]
	 */
	private function sortSlideSetCache()
	{
		$slide = SlideRepositoryEloquent::all()->toArray();
		if ($slide) {
			// 缓存幻灯片数据
			cache()->forever(config('admin.global.cache.slideList'),$slide);
			return $slide;
			
		}
		return '';
	}

	/**
	 * 添加数据
	 * @author wenhaiqing
	 * @date   2017-08-01T09:18:45+0800
	 * @return [type]                   [description]
	 */
	public function store($attributes)
	{
		try {
			$result = SlideRepositoryEloquent::create($attributes);
			if ($result) {
				// 更新缓存
				$this->sortSlideSetCache();
			}
			return [
				'status' => $result,
				'message' => $result ? trans('common.create_success'):trans('common.create_error'),
			];
		} catch (Exception $e) {
			return [
				'status' => false,
				'message' => trans('common.create_error'),
			];
		}
	}


	/**
	 * 删除数据
	 * @author wenhaiqing
	 * @date   2017-08-01T11:02:01+0800
	 * @param  string                   $value [description]
	 * @return [type]                          [description]
	 */
	public function destroy($id)
	{
		try {
			$result = SlideRepositoryEloquent::delete($id);
			if ($result) {
				$this->sortSlideSetCache();
			}
            return [
                'status' => 0,
                'msg' => $result ? trans('common.destroy_success'):trans('common.destroy_error'),
            ];
		} catch (Exception $e) {
            return [
                'status' => 1,
                'msg' => trans('common.destroy_error'),
            ];
		}
	}

	public function cacheClear()
	{
		cache()->forget(config('admin.global.cache.slideList'));
		flash(trans('common.cache_clear'), 'success')->important();
	}

}