<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "s3", "rackspace"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_KEY'),
            'secret' => env('AWS_SECRET'),
            'region' => env('AWS_REGION'),
            'bucket' => env('AWS_BUCKET'),
        ],

        'qiniu' => [
            'driver'  => 'qiniu',
            'domains' => [
                'default'   => 'omnqvls2t.bkt.clouddn.com', //你的七牛域名
                'https'     => 'xxxxx',         //你的HTTPS域名
                'custom'    => 'cache.whqrlm.com',     //你的自定义域名
            ],
            'access_key'=> '0TSRv6Rq9GGve3_C9XSgRaEYsyqUKUbE_ydv8139',  //AccessKey
            'secret_key'=> 'lfIcf_uS5PEvDDH9Cj8aMYhuxdoARHHHxqrYRzSl',  //SecretKey
            'bucket'    => 'wenhaiqing',  //Bucket名字
            'notify_url'=> '',  //持久化处理回调地址
            'access'    => 'public', //空间访问控制 public 或 private,
            'qiniuhttp' => 'http://omnqvls2t.bkt.clouddn.com/'//该参数是用户删除七牛图片时去除域名只传图片路径参数
        ],

    ],



];
