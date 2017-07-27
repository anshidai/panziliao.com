<?php 

namespace console\models\ar;

use yii\mongodb\Query as MongoQuery;
use yii\data\ActiveDataProvider;

/**
* 参考 
* http://www.form1.cn/php-yii2-143.html
* http://blog.csdn.net/xmlife/article/details/46471671
* http://www.yiiframework.com/doc-2.0/yii-mongodb-query.html
*/
class ARIndexUrl extends \yii\mongodb\ActiveRecord
{
	public static function collectionName()
	{
		return 'pzl_index_url';
	}

	public static function getUrlTotal()
	{
		return parent::find()->one();
	}

	public static function getUrlList($pageindex = 1, $pagesize = 20)
	{
		/*
		$query = new MongoQuery();
		$query->select(array())
				->from()
				->offset()
				->limit($pagesize);
		$res = $query->all();
		return $res;
		*/
	}


}