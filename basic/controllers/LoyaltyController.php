<?php
namespace app\controllers;

use yii\web\Controller;
use yii\data\Pagination;

class LoyaltyController extends Controller{

	public $enableCsrfValidation = false;
	//call API function
	private function getinfo($url,$arr){
		$ch=curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $arr);
        $output = curl_exec($ch);
        curl_close($ch);
        $info=json_decode($output,true);
        return $info;
	}

	//show create page
	public function actionCreatecus(){
		return $this->render('createcus');
	}

	//1.1 Customer Create New
	public function actionDocreate(){
		$url="http://202.177.204.24/customer/create";
		$_POST['username']='satami';
		$_POST['password']='sata1234';
		$_POST['account_id']='satamihk';
		$info=$this->getinfo($url,$_POST);
		// var_dump($info);
		if($info['status']=="success"){
			\Yii::$app->getSession()->setFlash('success', 'Created Successfully');
			return $this->redirect(['loyalty/listcus']);
		}else{
			\Yii::$app->getSession()->setFlash('error', 'Created Failed');
			return $this->redirect(['loyalty/listcus']);
		}
	}

	//1.3 customer search/list customers
	public function actionListcus(){
		$url="http://202.177.204.24/customer/search";
        $arr=array("username" => "satami","password" => "sata1234","account_id"=>"satamihk");
        $info=$this->getinfo($url,$arr);
        $count=count($info);
        $pages = new Pagination(['totalCount' =>$count, 'pageSize' => '20']);
        $infos=array_slice($info,$pages->offset,$pages->limit);
        return $this->render('listcus',['infos'=>$infos,'pages'=>$pages]);
	}

	//1.3 customer search/list customers
	public function actionSearchcus(){
		// var_dump($_POST['condition']);exit;
		$url="http://202.177.204.24/customer/search";
		$_POST['username']='satami';
		$_POST['password']='sata1234';
		$_POST['account_id']='satamihk';
		// var_dump($_POST);exit;
        // $arr=array("username" => "satami","password" => "sata1234","account_id"=>"satamihk");
        $info=$this->getinfo($url,$_POST);
        $count=count($info);
        $pages = new Pagination(['totalCount' =>$count, 'pageSize' => '20']);
        $infos=array_slice($info,$pages->offset,$pages->limit);
        return $this->render('listcus',['infos'=>$infos,'pages'=>$pages]);
	}

	//1.5 Customer -update
	public function actionUpdatecus(){
		//get cus data
		$code=base64_decode($_GET['code']);
		$url="http://202.177.204.24/customer/search";
		$arr=array("username" => "satami","password" => "sata1234","account_id"=>"satamihk","code"=>$code);
		$info=$this->getinfo($url,$arr);
		return $this->render('updatecus',['info'=>$info]);
	}

	//view cus info
	public function actionViewcus(){
		//get cus data
		$code=base64_decode($_GET['code']);
		$url="http://202.177.204.24/customer/search";
		$arr=array("username" => "satami","password" => "sata1234","account_id"=>"satamihk","code"=>$code);
		$info=$this->getinfo($url,$arr);
		return $this->render('viewcus',['info'=>$info]);
	}

	//1.5 Customer -update
	public function actionDoupdate(){
		// var_dump($_POST);exit;
		$updateurl="http://202.177.204.24/customer/update";
		$_POST['username']='satami';
		$_POST['password']='sata1234';
		$_POST['account_id']='satamihk';
		$update=$this->getinfo($updateurl,$_POST);
		if($update['status']=="success"){
			\Yii::$app->getSession()->setFlash('success', 'Updated Successfully');
			return $this->redirect(['loyalty/listcus']);	
		}else{
			\Yii::$app->getSession()->setFlash('error', 'Updated Failed');
			return $this->redirect(['loyalty/updatecus']);
		}
	}

	//1.7 Customer -Delete
	public function actionDeletecus(){
		$code=base64_decode($_GET['code']);
		$url="http://202.177.204.24/customer/delete";
		$arr=array("username" => "satami","password" => "sata1234","account_id"=>"satamihk","code"=>$code);
		$info=$this->getinfo($url,$arr);
		if($info['status']=="success"){
			\Yii::$app->getSession()->setFlash('success', 'Delete Successfully');
			return $this->redirect(['loyalty/listcus']);	
		}else{
			\Yii::$app->getSession()->setFlash('error', 'Delete Failed');
			return $this->redirect(['loyalty/listcus']);
		}
	}

}