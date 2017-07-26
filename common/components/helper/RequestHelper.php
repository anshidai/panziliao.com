<?php 

namespace common\components\helper;

/**
* request 请求类
*/
class RequestHelper
{
	/**
	* 获取请求类型 
	* @return string  HEAD GET POST PUT DELETE
	*/
	public static function getMethod()
	{
        if(isset($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE'])) {
            return strtoupper($_SERVER['HTTP_X_HTTP_METHOD_OVERRIDE']);
        }
        if(isset($_SERVER['REQUEST_METHOD'])) {
            return strtoupper($_SERVER['REQUEST_METHOD']);
        }
        return 'GET';
	}
	
	/**
	* 判断是否ajax请求
	* @return boole 
	*/
	public static function isAjax()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }
	
	/**
	 * 是否是POST提交
	 * @return int
	 */
	public static function isPost() 
	{
		return ($_SERVER['REQUEST_METHOD'] == 'POST' && (empty($_SERVER['HTTP_REFERER']) || preg_replace("~https?:\/\/([^\:\/]+).*~i", "\\1", $_SERVER['HTTP_REFERER']) == preg_replace("~([^\:]+).*~", "\\1", $_SERVER['HTTP_HOST']))) ? true : false;
	}
	
	/**
	 * 判断是否SSL协议
	 * @return bool
	 */
	public static function isSsl() 
	{
		if(isset($_SERVER['HTTPS']) && ('1' == $_SERVER['HTTPS'] || 'on' == strtolower($_SERVER['HTTPS']))) {
			return true;
		}elseif(isset($_SERVER['SERVER_PORT']) && ('443' == $_SERVER['SERVER_PORT'] )) {
			return true;
		}
		return false;
	}
	
	/**
	* 判断是否移动端
	* @return boole 
	*/
	public static function isMobile()
	{
		$mobile = new \common\components\helper\MobileHelper();
		return $mobile->isMobile();
	}
	
	/**
     * 检查是否是nodeServer
     */
    public static function isNodeServer()
	{
        if(strpos($_SERVER['HTTP_USER_AGENT'], 'mNodeServer') !== false) {
            return true;
        }
		return false;
	}
	
	/**
     * 检查是否是微信
     */
    public static function isWX()
    {
        $isWX = (isset($_SERVER['HTTP_USER_AGENT']) && stripos($_SERVER['HTTP_USER_AGENT'], 'micromessenger') !== false ? true : false);
        return $isWX;
    }
    
	/**
     * 获得当前请求的地址
	 * @author libaoan@kezhanwang.cn 2016/12/16
     */
    public static function getCurPageUrl()
    {
        $pageURL = 'http';
		if($_SERVER['HTTPS'] == 'on') {
			$pageURL .= 's';
		}
		$pageURL .= '://';
		if($_SERVER['SERVER_PORT'] != '80') {
			$pageURL .= $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI'];
		}else {
			$pageURL .= $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
		}
		
		return $pageURL;
    }
	
	/**
	* 获取客户端IP地址
	* @param int $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
	* @param bool $adv 是否进行高级模式获取（有可能被伪装） 
	* @return string
	*/
	public static function getClientIp($type = 0, $adv = false) 
	{
		static $ip = null;
		
		$type = $type? 1: 0;
		if($ip !== null) return $ip[$type];
		if($adv){
			if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				$arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
				$pos = array_search('unknown', $arr);
				if(false !== $pos) unset($arr[$pos]);
				$ip = trim($arr[0]);
			}elseif(isset($_SERVER['HTTP_CLIENT_IP'])) {
				$ip = $_SERVER['HTTP_CLIENT_IP'];
			}elseif(isset($_SERVER['REMOTE_ADDR'])) {
				$ip = $_SERVER['REMOTE_ADDR'];
			}
		}elseif(isset($_SERVER['REMOTE_ADDR'])) {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		// IP地址合法验证
		$long = sprintf("%u", ip2long($ip));
		$ip = $long? array($ip, $long): array('0.0.0.0', 0);
		return $ip[$type];
	}
	
	/**
	* 发送HTTP状态
	* @param int $code 状态码
	* @return string
	*/
	public static function sendHttpStatus($code) 
	{
		static $_status = array(
				// Informational 1xx
				100 => 'Continue',
				101 => 'Switching Protocols',
				// Success 2xx
				200 => 'OK',
				201 => 'Created',
				202 => 'Accepted',
				203 => 'Non-Authoritative Information',
				204 => 'No Content',
				205 => 'Reset Content',
				206 => 'Partial Content',
				// Redirection 3xx
				300 => 'Multiple Choices',
				301 => 'Moved Permanently',
				302 => 'Moved Temporarily ',  // 1.1
				303 => 'See Other',
				304 => 'Not Modified',
				305 => 'Use Proxy',
				// 306 is deprecated but reserved
				307 => 'Temporary Redirect',
				// Client Error 4xx
				400 => 'Bad Request',
				401 => 'Unauthorized',
				402 => 'Payment Required',
				403 => 'Forbidden',
				404 => 'Not Found',
				405 => 'Method Not Allowed',
				406 => 'Not Acceptable',
				407 => 'Proxy Authentication Required',
				408 => 'Request Timeout',
				409 => 'Conflict',
				410 => 'Gone',
				411 => 'Length Required',
				412 => 'Precondition Failed',
				413 => 'Request Entity Too Large',
				414 => 'Request-URI Too Long',
				415 => 'Unsupported Media Type',
				416 => 'Requested Range Not Satisfiable',
				417 => 'Expectation Failed',
				// Server Error 5xx
				500 => 'Internal Server Error',
				501 => 'Not Implemented',
				502 => 'Bad Gateway',
				503 => 'Service Unavailable',
				504 => 'Gateway Timeout',
				505 => 'HTTP Version Not Supported',
				509 => 'Bandwidth Limit Exceeded'
		);
		if(isset($_status[$code])) {
			header('HTTP/1.1 '.$code.' '.$_status[$code]);
			// 确保FastCGI模式下正常
			header('Status:'.$code.' '.$_status[$code]);
		}
	}
	
	
}

