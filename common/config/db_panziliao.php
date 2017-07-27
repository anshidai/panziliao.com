<?php 

/**
* mysql数据配置
*/

if(YII_ENV == 'online') {
	//生产环境
	return array(
		'class' => 'yii\db\Connection',
		'dsn' => 'mysql:host=localhost;port=3306;dbname=panziliao', 
		'username' => 'panziliao',
		'password' => '%%panziliao!@#',
		'charset' => 'utf8',
	);
	
}else {
	//开发&&测试环境
	return array(
		'class' => 'yii\db\Connection',
		'dsn' => 'mysql:host=127.0.0.1;port=3306;dbname=panziliao', 
		'username' => 'root',
		'password' => 'root',
		'charset' => 'utf8',
	);
}

