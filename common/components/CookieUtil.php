<?php 

namespace common\components;

use Yii;

/**
* cookie处理类
* Yii2.0的Cookies不同于常规的PHP的Cookie设置，
* Yii2.0Cookies使用Cookie类自定义名称、值、过期时间；然后将设置好的cookie配置项装载到CookieCollection中。
* 然后服务器端处理完客户端提交的数据后返回触发Yii::$app->response中的事件；将调用Yii::$app->response->send()方法
* @link http://www.cnblogs.com/itsharehome/p/5010732.html
*/
class CookieUtil
{
	/**
	* 写cookie, 程序后续执行没有exit或die 退出情况下使用
	*/
	public static function set($name, $value, $expire = 0, $domain = '', $path = '/', $httpOnly = false)
	{
		self::_setCookie($name, $value, $expire, $domain, $path, $httpOnly);
	}
	
	/**
	* 写cookie, 程序后续执行exit或die 退出情况下使用
	*/
	public static function setSend($name, $value, $expire = 0, $domain = '', $path = '/', $httpOnly = false)
	{
		self::_setCookie($name, $value, $expire, $domain, $path, $httpOnly);
		Yii::$app->response->send();
	}
	
	/**
	* 设置cookie
	* @param string $name 名称
	* @param string $value 值
	* @param string $expire 过期时间 单位/秒
	*/
	protected static function _setCookie($name, $value, $expire = 0, $domain = '', $path = '/', $httpOnly = false)
	{
		if($expire && is_numeric($expire)){
			$expire = time() + $expire;
		}
		if(empty($domain)) {
			$domain = defined('COOKIE_DOMAIN')? COOKIE_DOMAIN: '';
		}
		$cookies = Yii::$app->response->cookies;
		$cookies->add(new \yii\web\Cookie([
				'name' => $name,
				'value' => $value,
				'expire' => $expire,
				'domain' => $domain,
				'path' => $path,
				'httpOnly' => $httpOnly,
		]));
	}

	/**
	* 获取cookie
	* @param string $name 名称
	*/
	public static function get($name)
	{
		$cookies = Yii::$app->request->cookies;
		return $cookies->getValue($name);
	}
	
	/**
	* 删除cookie
	* @param string $name 名称
	*/
	public static function del($name)
	{
		$cookies = Yii::$app->response->cookies;
		$cookies->remove($name);
		unset($cookies[$name]);
	}
	
}

