<?php

$cachekey = require __DIR__ . '/cachekey.php';
$attribute = require __DIR__ . '/attribute.php';
return [
	//定义redis,memcache,filecache等缓存key
	'cachekey' => $cachekey,
	
	//定义分类
	//'category' => $attribute['category'],
];
