<?php
return [
	// 自定义用户名
	'username' => 'name',
	// 默认主题
	'theme' => 'default',
	// 创建 service 文件配置
	'command' => [
		// service 目录名称
		'namespace' => 'Services\\',
	],
	// id加密配置
	'encrypt' => [
		'main' => true,
		'permission' => true,
		'role' => true,
		'user' => true,
		'menu' => true,
	],
	'cache' => [
		'menuList' => 'menuList',
		'categoryList' => 'categoryList',
		'slideList' => 'slideList',
		'toplineList' => 'toplineList',
		'app_home_categoryList' => 'app_home_categoryList',
		'app_skillerList' => 'app_skillerList',
		'app_demandList' => 'app_demandList'
	],
];