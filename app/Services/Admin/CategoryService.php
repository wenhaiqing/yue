<?php
namespace App\Services\Admin;

use Facades\ {
    App\Repositories\Eloquent\CategoryRepositoryEloquent,
    App\Repositories\Eloquent\PermissionRepositoryEloquent
};

use Exception;

class CategoryService {

	protected $module = 'category';

	/**
	 * 获取菜单数据
	 * @Author   wenhaiqing
	 * @DateTime 2017-07-31T21:44:41+0800
	 * @return   [type]                   [description]
	 */
	public function getCategoryList()
	{
		// 判断数据是否缓存
		if (cache()->has(config('admin.global.cache.categoryList'))) {
			return cache()->get(config('admin.global.cache.categoryList'));
		}
		return $this->sortCategorySetCache();
	}

	/**
	 * 递归菜单数据
	 * @Author   wenhaiqing
	 * @DateTime 2017-07-31T21:42:01+0800
	 * @param    [type]                   $Categorys [description]
	 * @param    integer                  $pid   [description]
	 * @return   [type]                          [description]
	 */
	private function sortCategory($Categorys,$pid=0)
	{
		$arr = [];
		if (empty($Categorys)) {
			return '';
		}
		foreach ($Categorys as $key => $v) {
			if ($v['pid'] == $pid) {
				$arr[$key] = $v;
				$arr[$key]['child'] = self::sortCategory($Categorys,$v['id']);
			}
		}
		return $arr;
	}
	
	/**
	 * 排序子菜单并缓存
	 * @Author   wenhaiqing
	 * @DateTime 2017-07-31T21:42:12+0800
	 * @return   [type]                   [description]
	 */
	private function sortCategorySetCache()
	{
		$Categorys = CategoryRepositoryEloquent::all()->toArray();
		if ($Categorys) {
			$categoryList = $this->sortCategory($Categorys);
			foreach ($categoryList as $key => &$v) {
				if ($v['child']) {
					$sort = array_column($v['child'], 'sort');
					array_multisort($sort,SORT_DESC,$v['child']);
				}
			}
			// 缓存菜单数据
			cache()->forever(config('admin.global.cache.categoryList'),$categoryList);
			return $categoryList;
			
		}
		return '';
	}

	/**
	 * 添加菜单视图
	 * @Author   wenhaiqing
	 * @DateTime 2017-07-31T22:53:43+0800
	 * @return   [type]                   [description]
	 */
	public function create()
	{
		$Categories = $this->getcategoryList();
		return compact('Categories');
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
			$result = CategoryRepositoryEloquent::create($attributes);
			if ($result) {
				// 更新缓存
				$this->sortCategorySetCache();
			}
			return [
				'status' => $result,
				'message' => $result ? trans('common.create_success'):trans('common.create_error'),
			];
		} catch (Exception $e) {
			dd($e);
			return [
				'status' => false,
				'message' => trans('common.create_error'),
			];
		}
	}

	/**
	 * 查看数据
	 * @author wenhaiqing
	 * @date   2017-08-01T10:37:41+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function show($id)
	{
		try {
			$categorys = $this->getcategoryList();
			$category = CategoryRepositoryEloquent::find(decodeId($id, $this->module));
			return compact('categorys', 'category');
		} catch (Exception $e) {
			abort(500);
		}
	}

	public function edit($id)
	{
		try {
			$attr = $this->show($id);
			$permissions = PermissionRepositoryEloquent::all(['name']);
			return array_merge($attr, compact('permissions'));
		} catch (Exception $e) {
			abort(500);
		}
	}

	/**
	 * 修改数据
	 * @author wenhaiqing
	 * @date   2017-08-01T10:37:50+0800
	 * @param  [type]                   $id [description]
	 * @return [type]                       [description]
	 */
	public function update($attributes, $id)
	{

		try {
				if(decodeId($id,$this->module) == $attributes['pid'] && $attributes['pid'] !=0){
					return [
						'status' =>0,
						'message' => trans('category.pid_error'),
					];
				}

			$isUpdate = CategoryRepositoryEloquent::update($attributes, decodeId($id, $this->module));
			if ($isUpdate) {
				// 更新缓存
				$this->sortCategorySetCache();
			}
			return [
				'status' => $isUpdate,
				'message' => $isUpdate ? trans('common.edit_success'):trans('.common.edit_error'),
			];
		} catch (Exception $e) {
			return [
				'status' => false,
				'message' => trans('common.edit_error'),
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
			$result = CategoryRepositoryEloquent::delete(decodeId($id, $this->module));
			if ($result) {
				$this->sortCategorySetCache();
			}
			flash_info($result,trans('common.destroy_success'),trans('common.destroy_error'));
		} catch (Exception $e) {
			flash(trans('common.destroy_error'), 'danger');
		}
	}

	public function cacheClear()
	{
		cache()->forget(config('admin.global.cache.categoryList'));
		flash(trans('common.cache_clear'), 'success')->important();
	}

}