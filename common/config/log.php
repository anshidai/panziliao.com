<?php 

return array(
	'traceLevel' => YII_DEBUG ? 3 : 0,
	'targets' => array(
		array(
			'class' => 'yii\log\FileTarget',
			'levels' => array('error', 'warning', 'info'),
			'categories' => array('application', 'yii\web\HttpException', 'yii\base\ErrorException'),
			'logFile' => '@app/runtime/logs/app.' . date('Ymd') . '.log',
			'logVars' => array(),
		),
		//array(
			/*
			* 定义java接口请求 记录日志
			* levels 用法：
			* 例 'levels' => array('trace','error','warning','info'),
			* trace 主要是用于开发目的，用以标明某些代码的运作流程。注意：它只在开发模式下才起效， 也就是 YII_DEBUG 是 true 的时候
			* error 记录一个致命错误消息
			* warning 记录一个警告消息
			* info 记录一些有用信息的消息
			*/
			//'class' => 'yii\log\FileTarget',
			//'levels' => array('error','warning','info'),
			//'categories' => array('java.api'), //标示 用法 Yii::info($message, 'java.api');
			//'logFile' => '@app/runtime/logs/javaApi/java.api.log', //日志文件名
			//'maxFileSize' => 1024 * 2, //单个文件大小 单位/M
			//'maxLogFiles' => 20, //日志文件个数
			//'logVars' => array(), //日志返回信息行为，默认日志信息包含$_GET，$_POST，$_SESSION，$_COOKIE，$_FILES 和 $_SERVER
		//),
	),
);