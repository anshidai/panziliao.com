<?php

namespace console\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\mongodb\Query;

/**
* 数据从mongodb迁移到Mysql
* 执行脚本 php ./yii mongo-to-mysql xxx
*/
class MongoToMysqlController extends \yii\console\Controller
{
	
	public $mongo = null;
	public $db = null;

	public function init()
	{
		parent::init();

		$this->mongo = Yii::$app->mongodb;
		$this->db = Yii::$app->db_panziliao;
	}

	/**
	* 导入采集url
	*/
	public function actionImportcjurl()
	{
		$query = new Query();
		$query->from('pzl_index_url');
		$provider = new ActiveDataProvider([
		    'query' => $query,
		    'pagination' => [
		        'pageSize' => 10,
		    ]
		]);
		$models = $provider->getModels();
		var_dump($models);
	}

	/**
	*
	*/
	public function actionImportUserBase()
	{

	}


}