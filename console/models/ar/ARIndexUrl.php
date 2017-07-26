<?php 

namespace console\models\ar;

use yii\mongodb\Query;
use yii\mongodb\ActiveRecord;
use yii\data\ActiveDataProvider;


/**
* 参考 http://www.form1.cn/php-yii2-143.html
*/
class ARIndexUrl extends ActiveRecord
{
	public static function collectionName()
	{
		return 'pzl_index_url';
	}

	public static function getUrlTotal()
	{

	}

	public static function getUrlList($pageindex = 1, $pagesize = 20)
	{
		$query = new Query();
		$query->select(array())
				->from()
				->offset()
				->limit($pagesize);
		$res = $query->all();
		return $res;
	}


}