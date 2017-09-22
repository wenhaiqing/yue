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
		'categoryList' => 'categoryList'
	],
	'sms' => [
		// HTTP 请求的超时时间（秒）
		'timeout' => 5.0,

		// 默认发送配置
		'default' => [
			// 网关调用策略，默认：顺序调用
			'strategy' => \Overtrue\EasySms\Strategies\OrderStrategy::class,

			// 默认可用的发送网关
			'gateways' => [
				'alidayu',
			],
		],
		// 可用的网关配置
		'gateways' => [
			'errorlog' => [
				'file' => '/tmp/easy-sms.log',
			],
			'yunpian' => [
				'api_key' => '824f0ff2f71cab52936axxxxxxxxxx',
			],
			'aliyun' => [
				'access_key_id' => '',
				'access_key_secret' => '',
				'sign_name' => '',
			],
			'alidayu' => [
				'app_key' => '23817263',
				'app_secret' => '470451afe0c9255b18779da70e54a2d2',
				'sign_name' => '山西菜市场',
			],
		],
	],
];