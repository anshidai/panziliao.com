<?php 

namespace common\components;

use Yii;

/**
* session处理类
*/
class SessionUtil
{
	/**
	* 设置session
	*/
	public static function set($name, $value)
	{
		$session = Yii::$app->session;
		$session->set($name, $value);
	}
	
	/**
	* 获取session
	*/
	public static function get($name)
	{
		$session = Yii::$app->session;
		return $session->get($name);
		
	}
	
	/**
	* 删除session
	*/
	public static function del($name)
	{
		$session = Yii::$app->session;
		$session->remove($name);
	}
	
}

