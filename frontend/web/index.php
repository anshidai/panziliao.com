<?php

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev'); //dev-开发&&测试环境  online-线上环境

if(YII_ENV == 'dev') {
	error_reporting(E_ALL &~ (E_WARNING|E_NOTICE));
}

//开始执行时间
defined('START_TIME') or define('START_TIME', time());

//模板风格
define('SKIN_THEM', 'default');

//应用根目录
define('APP_ROOT', substr(__DIR__, 0, -4));
//框架根目录
define('__ROOT__', substr(APP_ROOT, 0, -9));

require(__ROOT__ . '/vendor/autoload.php');
require(__ROOT__ . '/vendor/yiisoft/yii2/Yii.php');
require(__ROOT__ . '/common/config/bootstrap.php');
require(APP_ROOT . '/config/bootstrap.php');

$config = yii\helpers\ArrayHelper::merge(
    require(__ROOT__ . '/common/config/main.php'),
    require(APP_ROOT . '/config/main.php')
);

$application = new yii\web\Application($config);
$application->run();
