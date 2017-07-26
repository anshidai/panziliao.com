<?php

if(YII_ENV == 'online') {
	//正式环境
	$params = array_merge(
		require(__DIR__ . '/../../common/config/params.php'),
		require(__DIR__ . '/params.php')
	);
	require dirname(__FILE__) . '/constant.php';
	
} else {
	//开发&&测试环境
	$params = array_merge(
		require(__DIR__ . '/../../common/config/params-local.php'),
		require(__DIR__ . '/params-local.php')
	);
	require dirname(__FILE__) . '/constant-local.php';
}

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
		'urlManager' => [
			'class' => 'yii\web\UrlManager',
			'enablePrettyUrl' => true, //开启路由
			'showScriptName' => false, //隐藏入口脚本index.php
			'rules' => [
				'' => 'index/index',
				'peixun/?' => 'index/index',
				'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
				'<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
			],
		],
        'view' => [
			//开启主题
			'theme' => [
				//模板views目录映射到themes主题目录
				'pathMap' => ['@app/views' => '@app/themes/'.SKIN_THEM],
				
				//css,js,images目录映射
				//'basePath' => [],
				//'baseUrl' => [],
			],
		],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
];
