<?php

if(YII_ENV == 'online') {
	//正式环境
	require dirname(__FILE__) . '/constant.php';
	
} else {
	//开发&&测试环境
	require dirname(__FILE__) . '/constant-local.php';
}

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
    	/*
        'request' => [
			'cookieValidationKey' => 'q6ga0ArPuP1iWsey2H6aoeWsP7G98FnL',
			'enableCookieValidation' => false,
        ],
        */
		'log' => require dirname(__FILE__) . '/log.php',
		'db_panziliao' => require dirname(__FILE__) . '/db_panziliao.php',
		'redis' => require dirname(__FILE__) . '/redis.php',
		'mongodb' => require dirname(__FILE__) . '/mongo.php',
    ],
];
