<?php

/**
 * redis连接配置
 */
if(YII_ENV == 'online') {
	//生产环境
	return array(
			'class' => 'yii\redis\Connection',
			'hostname' => '10.28.119.136',
			'port' => 7379,
	);

} else {
	//开发环境
	return array(
			'class' => 'yii\redis\Connection',
			'hostname' => '127.0.0.1',
			'port' => 6379,
	);
}






