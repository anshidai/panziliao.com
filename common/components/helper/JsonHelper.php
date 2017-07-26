<?php 

namespace common\components\helper;

use yii\helpers\Json;

/**
* json处理类
*/
class JsonHelper extends Json
{
	/**
	* 输出json数据
	* @param string|array $data 待生成json内容
	* @param bool $isexit 是否结束程序
	*/
	public static function echocode($data, $isexit = true)
	{
		header('Content-Type: application/json');
		
		$json = self::encode($data);
		if(isset($_GET['callback'])) {
			$json = urlencode("{$_GET['callback']}({$json})");
		}
		if($isexit) {
			exit($json);
		}
		return $json;
	}
	
	/**
	* 数据格式化成json
	* @param string|array $value 待生成json内容
	* @return string json字符
	*/
	public static function encode($value, $options = 320)
	{
		return parent::encode($value, $options);
	}
	
	/**
	* 解析json数据
	* @param string $json 解析的数据
	* @param bool $asArray 结果是否返回数组格式
	*/
	public static function decode($json, $asArray = true)
	{
		return parent::decode($json, $asArray);
	}
	
	public static function htmlEncode($value)
	{
		return parent::htmlEncode($value);
	}

}


