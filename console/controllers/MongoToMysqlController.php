<?php

namespace console\controllers;

use Yii;
use console\models\ar\ARIndexUrl;

/**
* 数据从mongodb迁移到Mysql
* 执行脚本 php ./yii mongo-to-mysql/xxx  访问时候大写字母前用横线-
*/
class MongoToMysqlController extends \yii\console\Controller
{
	
	public $mongo = null;
	public $db = null;
	const TABLE_INDEX_URL = 'pzl_index_url';

	public function init()
	{
		parent::init();

		//$this->mongo = Yii::$app->mongodb;
		//$this->db = Yii::$app->db_panziliao;
	}

	/**
	* 导入采集url
	*/
	public function actionImportcjurl()
	{	
		/*
		$mongo = new MongoQuery();
		$mongo->from('pzl_index_url');
		$provider = new ActiveDataProvider([
		    'query' => $mongo,
		    'pagination' => [
		        'pageSize' => 10,
		    ]
		]);
		$models = $provider->getModels();
		var_dump($models);
		*/
	}

	/**
	*
	*/
	public function actionImportuserbase()
	{
		//$collection = $this->mongo->getCollection(self::TABLE_INDEX_URL);
		//$res = $collection->
		//var_dump($collection);
		$res = ARIndexUrl::getUrlTotal();
		var_dump($res);

	}


}