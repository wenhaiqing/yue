<?php
/**
 * 主题下视图文件路径
 */
if(!function_exists('getThemeView')){
	function getThemeView($view)
	{
		return 'themes.admin.'.getTheme().'.'.$view;
	}
}

/**
 * 获取主题
 */
if(!function_exists('getTheme')){
	function getTheme()
	{
		if (cache()->has('theme')) {
			return cache('theme');
		}
		$theme = config('admin.global.theme');
		cache()->forever('theme', $theme);
		return $theme;
	}
}

/**
 * 获取页面资源文件
 */
if(!function_exists('getThemeAssets')){
	function getThemeAssets($asset, $vendors = false)
	{
		return $vendors ? 'vendors/'.$asset : 'themes/admin/'.getTheme().'/'.$asset;
	}
}

/**
 * 刷新用户权限、角色
 */
if(!function_exists('setUserPermissions')){
	function setUserPermissions($user)
	{
		$rolePermissions = $user->rolePermissions()->get()->pluck('slug');
        $userPermissions = $user->userPermissions()->get()->pluck('slug');
        $permissions = array_unique($rolePermissions->merge($userPermissions)->all());

        $roles = $user->getRoles()->pluck('slug')->all();
        $allPermissions = \App\Models\Permission::all()->pluck('slug')->all();

        // 缓存用户权限
        cache()->forever('user_'.$user->id, [
        	'permissions' => $permissions,
        	'roles' => $roles,
        	'allPermissions' => $allPermissions
        ]);
	}
}

/**
 * 清空缓存
 */
if(!function_exists('cacheClear')){
	function cacheClear()
	{
		cache()->flush();
	}
}
/**
 * 获取当前用户权限、角色
 */
if(!function_exists('getCurrentPermission')){
	function getCurrentPermission($user)
	{
		$key = 'user_'.$user->id;

		if (cache()->has($key)) {
			return cache($key);
		}

		setUserPermissions($user);
	}
}
/**
 * 操作提示信息
 */
if(!function_exists('flash_info')){
	function flash_info($result,$successMsg = 'success !',$errorMsg = 'something error !')
	{
		return $result ? flash($successMsg,'success')->important() : flash($errorMsg,'danger')->important();
	}
}

/**
 * 加密
 */
if(!function_exists('encodeId')){
	function encodeId($id,$connection = 'main')
	{
		if (!config('hashids.connections.'.$connection)) {
			$connection = 'main';
		}
		// 获取加密配置
		$settings = config('admin.global.encrypt');
		// 判断是否开启加密设置
		if(isset($settings[$connection]) && $settings[$connection]){
			return Hashids::connection($connection)->encode($id);
		}
		return $id;
	}
}

if(!function_exists('decodeId')){
	function decodeId($id,$connection = 'main', $type = false)
	{
		if (!config('hashids.connections.'.$connection)) {
			$connection = 'main';
		}

		// 获取加密配置
		$settings = config('admin.global.encrypt');
		// 判断是否开启加密设置
		
		if(isset($settings[$connection]) && $settings[$connection]){
			$id = Hashids::connection($connection)->decode($id);
			if ($id) {
				return $type ? $id:$id[0];
			}
			flash(trans('common.decode_error'), 'danger');
			return 0;
		}
		return $id;
	}
}

if(!function_exists('haspermission')){
	function haspermission($permission)
	{
        $check = false;
        if (auth()->check()) {
            
            $user = auth()->user();
            $userPermissions =  getCurrentPermission($user);
			if($userPermissions){
				$check = in_array($permission, $userPermissions['permissions']);

				if (in_array('admin', $userPermissions['roles']) && !$check) {

					$newPermission = \App\Models\Permission::firstOrCreate([
						'slug' => $permission,
					],[
						'name' => $permission,
						'description' => $permission,
					]);
					$role = \App\Models\Role::where('slug', 'admin')->first();
					$role->attachPermission($newPermission);
					setUserPermissions($user);
					$check = true;
				}
			}

        }
        return $check;
	}


	if (!function_exists('getDistance')){
        function getDistance($lat1, $lng1, $lat2, $lng2) {
            //地球半径
            $R = 6378137;
            //将角度转为狐度
            $radLat1 = deg2rad($lat1);
            $radLat2 = deg2rad($lat2);
            $radLng1 = deg2rad($lng1);
            $radLng2 = deg2rad($lng2);
            //结果
            $s = acos(cos($radLat1)*cos($radLat2)*cos($radLng1-$radLng2)+sin($radLat1)*sin($radLat2))*$R;
            //精度
            $s = round($s* 10000)/10000;
            return  round($s);
        }
    }
}