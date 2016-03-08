<?php
return [
    'name' => 'Yiipal CMS',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
//        'urlManager' => [
//            'class' => 'yii\web\UrlManager',
//            'enablePrettyUrl' => true,
//            'showScriptName' => false,
//        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
    ],
    'language' => 'zh-CN',
];
