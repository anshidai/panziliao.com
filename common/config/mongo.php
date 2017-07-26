<?php 

/**
* mongodb链接
*/
if(YII_ENV == 'online') {
	//生产环境
	return array(
		'class' => 'yii\mongodb\Connection',
		'dsn' => 'mongodb://10.28.119.136:28018/panziliao',
	);
}else {
	//开发环境
	return array(
		'class' => 'yii\mongodb\Connection',
		'dsn' => 'mongodb://47.93.86.191:28018/panziliao',
	);
}

