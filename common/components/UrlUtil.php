<?php 

namespace common\components;

use yii\helpers\Url;

/**
* url处理类
*/
class UrlUtil extends Url
{
	/**
	* url规则
	* 格式：域名_控制器名_方法 => 映射url
	* 域名常量使用方法：
		格式: {常量名},  如: {DOMAIN_M}
	* 动态参数使用方法：
		格式: %s 或 %d, 如: {DOMAIN_M}/profile/detail?id=%d
	*/
	protected static $rules = array(
		
	);
	
	/**
	* 输出url
	* @param string $name url映射键名
	* @param array $arguments 动态参数
	* @param string $domain 域名
	*/
	public static function url($name, $arguments = array(), $domain = '')
	{
		$name = strtolower($name);
		if(!isset(self::$rules[$name])) return '';

		if(!is_array($arguments)) {
			$arguments = array($arguments);
		}
		$url = self::$rules[$name];
		
		//设置参数大于实际传入参数，则用空元素填充缺省传入参数
		if(preg_match_all('/%[%bcdeEufFgGosxX]/', $url, $matchNum)) {
			if(count($matchNum[0])>count($arguments)) {
				for($i=0; $i<=(count($matchNum[0])-count($arguments)); $i++) {
					array_push($arguments, '');
				}
			}
		}
		if(preg_match('/\{(.*)\}/', $url, $match)) {
			$url = str_replace($match[0], '', $url);
			if(defined($match[1])) {
				$url = constant($match[1]).$url;
			}
		}
		if(!empty($arguments)) {
			$url = call_user_func_array('sprintf', array_merge(array($url), $arguments));
		}
		if($domain && strpos($url, 'http://') === false) {
			$domain = strpos($domain, 'http://') === false? 'http://'.$domain: $domain;
			$url = rtrim($domain, '/').'/'.ltrim($url, '/');
		}

		return $url;
	}

}

