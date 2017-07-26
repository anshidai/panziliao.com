<?php 

namespace common\components;

use Yii;

/**
* 异常处理类
*/
class CException extends \Exception
{
	public function __construct($message = '', $code = 0)
	{
		parent::__construct($message, $code);
	}
	
	/**
	* 记录日志消息
	* @param string $message 日志内容
	* @param string $category 自定义日志文件标示
	*/
	public static function info($message = '', $category = 'application')
	{
		Yii::info($message, $category);
	}
	
	/**
	* 记录一个致命错误消息
	* @param string $message 日志内容
	* @param string $category 自定义日志文件标示
	*/
	public static function error($message = '', $category = 'application')
	{
		Yii::error($message, $category);
	}
	
	/**
	* 记录调试消息 开启YII_DEBUG=true生效
	* @param string $message 日志内容
	* @param string $category 自定义日志文件标示
	*/
	public static function trace($message = '', $category = 'application')
	{
		Yii::trace($message, $category);
	}
	
	/**
	* 记录一个警告消息
	* @param string $message 日志内容
	* @param string $category 自定义日志文件标示
	*/
	public static function warning($message = '', $category = 'application')
	{
		Yii::warning($message, $category);
	}
	
	
	
}