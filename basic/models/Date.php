<?php
namespace app\models;

use yii\base\Model;

class Date extends Model{

	public $date;
	public function rules(){

		return [
			['date','required'],//必填项
		];
	}
}
