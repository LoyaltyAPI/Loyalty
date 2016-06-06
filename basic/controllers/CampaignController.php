<?php
namespace app\controllers;

use yii\web\Controller;
use yii\data\Pagination;

class CampaignController extends Controller{

	// public $enableCsrfValidation = false;

	private $params=array('username'=>"satami",'password'=>"sata1234",'account_id'=>'satamihk');
	

	//show index page
	public function actionCreatecampaign(){

		return $this->render('createcampaign');
	}

	//2.1 create new campaign
	public function actionDocreatecampaign(){
		$url="http://202.177.204.24/campaign/new_campaign";
		$params=array_merge($this->params,$_POST['Campaign']);
		$res=$this->getinfo($url,$params);
		if($res['status']=="success"){
			\Yii::$app->getSession()->setFlash('success', 'Created Successfully');
			return $this->redirect(['index/index']);
		}else{
			\Yii::$app->getSession()->setFlash('error', 'Created Failed');
			return $this->redirect(['campaign/ceatecampaign']);
		}
	}


	//edit campagin
	public function actionEditcampaign(){
		$campaign_id=$_GET['campaign_id'];
		//campaign info
		$url="http://202.177.204.24/campaign/list_campaigns";
		$campaigns=$this->getinfo($url,$this->params);
		array_shift($campaigns);
		$campaignInfo=array();
		foreach($campaigns as $campaign){
			foreach ($campaign as $v) {
				if($v['id']==$campaign_id){
					$campaignInfo=$v;
				}
			}
		}
		//promotion list
		$url1="http://202.177.204.24/campaign/campaign_promos";
		$params['campaign_id']=$campaign_id;
		$params=array_merge($this->params,$params);
		$promos=$this->getinfo($url1,$params);
		return $this->render('editcampaign',['campaignInfo'=>$campaignInfo,"promos"=>$promos]);
	}

	//4.1 Report -All Transactions
	public function actionGetalltransactions(){		
	    //开启缓存
	    $cache = \yii::$app -> cache;	   
	    if(!empty($_POST)){//有条件查询
	    	 $cache -> flush();
	    	 $flag = $cache -> get('transactions');
	    	if(empty($flag)){//首次查询	
				$cache->add('transactions', $this -> getalltransaction($_POST,$this->params));
			}
	    }
		$transactions = $cache ->get('transactions');
		array_shift($transactions);
		if(!array_key_exists('transactions', $transactions)){
			$arr=array('title'=>'Campaigns Report','date'=>$_POST['Campaign']['date_start']." - ".$_POST['Campaign']['date_end']);
			return $this->render('noreport',['arr'=>$arr]);
		}
		$transactions=$transactions['transactions'];
		$count=count($transactions);
        $pages = new Pagination(['totalCount' =>$count, 'pageSize' => '10']);
        $transactions=array_slice($transactions,$pages->offset,$pages->limit);
		return $this->render('getalltransactions',['transactions'=>$transactions,'pages'=>$pages]);
	}

	private function getalltransaction($post,$params){
		$url="http://202.177.204.24/report/transactions_all";
		$campIds=implode(',',$post['Campaign']['selected_campaigns']);
		$post['Campaign']['selected_campaigns']=$campIds;
		$params=array_merge($params,$post['Campaign']);
		$transactions=$this->getinfo($url,$params);
		return $transactions;
	}

	//4.2 Report -All Campaigns
	public function actionGetallcustomers(){
		// var_dump($_POST['Campaign']);exit;
		$cache= \yii::$app -> cache;
		if(!empty($_POST)){
			$cache -> flush();
			$flag = $cache -> get('customers');
			if(empty($flag)){
				$cache->add('customers',$this -> getallcustomer($_POST,$this->params));
			}
		}
		$customers = $cache ->get('customers');
		array_shift($customers);
		$arr=array('title'=>'Customers Report','date'=>$_POST['Campaign']['date_start1']." - ".$_POST['Campaign']['date_end1']);
		if(!array_key_exists("customers", $customers)){
			return $this->render('noreport',['arr'=>$arr]);
		}
		$customers=$customers['customers'];
		$count=count($customers);
        $pages = new Pagination(['totalCount' =>$count, 'pageSize' => '10']);
        $customers=array_slice($customers,$pages->offset,$pages->limit);
		return $this->render('getallcustomers',['customers'=>$customers,'pages'=>$pages,'arr'=>$arr]);
	}

	private function getallcustomer(){
		$url="http://202.177.204.24/report/customers_all";
		$campIds=implode(',',$_POST['Campaign']['selected_campaigns1']);
		$post['date_start']=$_POST['Campaign']['date_start1'];
		$post['date_end']=$_POST['Campaign']['date_end1'];
		$post['selected_campaigns']=$campIds;
		$params=array_merge($this->params,$post);
		$customers=$this->getinfo($url,$params);
		return $customers;

	}

	//set depreciation for campaign

	public function actionSetdepreciation(){
		// var_dump($_POST);exit;
		$url="http://202.177.204.24/campaign/depreciation";
		$params=array_merge($this->params,$_POST['Campaign']);
		$re=$this->getinfo($url,$params);
		// var_dump($re);
		if($re['status']=="success"){
			\Yii::$app->getSession()->setFlash('success', 'Depreciation Set Successfully');
			return $this->redirect(['campaign/editcampaign',"campaign_id"=>$_POST['Campaign']['campaign_id']]);
		}else{
			\Yii::$app->getSession()->setFlash('error', $re["message"]);
			return $this->redirect(['campaign/editcampaign',"campaign_id"=>$_POST['Campaign']['campaign_id']]);
		}

	}

	//show promotion page 
	public function actionSetpromotion(){

		return $this->render('createpromotion');

	}
	//set promotion
	public function actionDosetpromotion(){	
		$url="http://202.177.204.24/campaign/promo";
		$params=array_merge($this->params,$_POST['Campaign']);
		$re=$this->getinfo($url,$params);
		if($re['status']=="success"){
			\Yii::$app->getSession()->setFlash('promosuccess', 'Pomotion Set Successfully');
			return $this->redirect(['campaign/editcampaign',"campaign_id"=>$_POST['Campaign']['campaign_id']]);
		}else{
			\Yii::$app->getSession()->setFlash('promoerror', 'Pomotion Set Failed');
			return $this->redirect(['campaign/setpromotion',"campaign_id"=>$_POST['Campaign']['campaign_id']]);
		}
	}

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

	//2.4 list campaigns 


}