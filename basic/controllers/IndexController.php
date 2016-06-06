<?php
namespace app\controllers;

use yii\web\Controller;
use yii\data\Pagination;

class IndexController extends Controller{

	private $params=array('username'=>"satami",'password'=>"sata1234",'account_id'=>'satamihk');
	//call API function
	private function getinfo($url,$params){
		$ch=curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        $output = curl_exec($ch);
        curl_close($ch);
        $info=json_decode($output,true);
        return $info;
	}
	//show index page
	public function actionIndex(){
		//list campaigns
		$url="http://202.177.204.24/campaign/list_campaigns";
		$campaigns=$this->getinfo($url,$this->params);
		array_shift($campaigns);
		$campArr=array();
		foreach ($campaigns as $v) {
			$campArr[]=$v['campaign'];
		}
		$count=count($campArr);
        $pages = new Pagination(['totalCount' =>$count, 'pageSize' => '10']);
        $campArr=array_slice($campArr,$pages->offset,$pages->limit);
		return $this->render('index',['campaigns'=>$campaigns,'campArr'=>$campArr,'pages'=>$pages]);
	}
}