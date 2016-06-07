<?php
namespace app\controllers;

/*
** created by Chris at Chengdu office
** on June 2th,2016
*/

use \yii\web\Controller;
use yii\data\Pagination;

use yii\helpers\Url;
class CustomerController extends Controller
{
	/*shut down the yii system validation*/
	// public $enableCsrfValidation = false;

	/*userinfo used for access Loyalty API*/
	private $userinfo = array(
	 	'username'  =>'satami',
		'password'  =>'sata1234',
		'account_id'=>'satamihk'
	);

	
	public function actionIndex(){
		$request = \yii::$app -> request;		
		$page    = $request  ->get('p','LookupCustomer');
		// var_dump($page);die;
		$campaign_id = $request -> get('campaign_id','29');
		return $this -> render('Index',['page'=>$page,'campaign_id'=>$campaign_id]);
	}
	/*create a new customer based on a given campagign ID*/
	public function actionAdd(){
		$request = \yii::$app -> request;
		$page = $request -> get('p');
		$campaign_id = $request -> get('campaign_id');
		// var_dump($campaign_id);
		return $this -> render('index',['page'=>$page,'campaign_id'=>$campaign_id]);
	}
	/*edit a customer's account*/
	public function actionEditcustomer(){
		$request = \yii::$app -> request;
		// var_dump($customer_code);die;
		$page = $request -> get('p');
		$data = array();
		$data['code'] = $request -> get('customer_code');
		$params = $this -> getparams('customer','search',$data);
		// var_dump($params);die;
		$res = $this -> getinfo($params['url'],$params['access_data']);
		// var_dump($res);die;
		return $this -> render('index',['page'=>$page,'acountDetail' => $res]);
	}

	/*save a customer's account info*/
	public function actionSavecustomer(){
		$request = \yii::$app -> request;
		$post = $request -> post();
		// var_dump($post);
		if(empty($post['Customer']['code'])){//add
			$params = $this -> getparams('customer','create',$post['Customer']);
			// var_dump($params);die;
			$res    = $this -> getinfo($params['url'],$params['access_data']);
			var_dump($res);die;
			if($res['status']=='success'){
				$this -> noticemsg('success','Congratulations! Create New Customer Successfully!');
				$this -> redirect(Url::toRoute(['customer/index']));
			}			
		}else{//update
			$params = $this -> getparams('customer','update',$post['Customer']);
			// var_dump($params);die;
			$res = $this -> getinfo($params['url'],$params['access_data']);
			// var_dump($res);die;
			if($res['status']=='success'){
				$this -> noticemsg('success','Congratulations! Update Customer Successfully!');
				$this -> redirect(Url::toRoute(['customer/index']));
			}
			
		}
	}

	/*look up customers from one campaign*/
	public function actionLookup(){
		// $campaignID = 29;		
		$request = \yii::$app -> request;		
		$post = $request -> post();
		// var_dump($post);die;
		if(!empty($post)){			
			$search_key = $this -> checksearchkeyword($post['Customer']['keyword']);
			$search_key['campaign_id'] = $post['Customer']['campaign_id'];
			$params = $this -> getparams('customer','search',$search_key);
			// var_dump($params);die;
			$res = $this -> getinfo($params['url'],$params['access_data']);
			// var_dump($res);die;
			if($res['status']=='error'){
				$this -> noticemsg('error','Sorry!No customers match criteria');
				$this -> redirect(Url::toRoute(['customer/index']));
			}else{
				$data = array();
				foreach($res as $key => $val){
					$data[$key]['name']  = $val['first_name'].''.$val['last_name'];
					$data[$key]['card']  = $val['card_number'];
					$data[$key]['phone'] = $val['phone'];
					$data[$key]['email'] = $val['email'];
				}
				return $this->render('Index',['page'=>'MatchedCustomerList','matchedCustomerList'=>$data]);			
			}			
		}
	}
   

	/*get a customer's detail info*/
	public function actionGetaccountdetail(){
		//get banlance_account 
		$data['campaign_id'] = 29;
		$data['code']        = '0338250724415429';
		$params = $this -> getparams('customer','customer_balance',$data);		
		$res    = $this -> getinfo($params['url'],$params['access_data']);
		// var_dump($res);die;

		//get user info
		$data1['code'] = '0338250724415429';
		$params = $this -> getparams('customer','search',$data1);
		// var_dump($params);die;
		$res1   = $this -> getinfo($params['url'],$params['access_data']);
		// var_dump($res1);die;

		$customerAccountDetail = array();		
		$customerAccountDetail['balance_points'] = $res['customer']['balance'];
		$customerAccountDetail['card_number']    = $res1[0]['card_number'];
		$customerAccountDetail['name']           = $res1[0]['first_name']."".$res1[0]['last_name'];
		$customerAccountDetail['phone']          = $res1[0]['phone'];
		$customerAccountDetail['mobile']		 = $res1[0]['mobile'];
		$customerAccountDetail['email'] 		 = $res1[0]['email'];
		$customerAccountDetail['address']        = $res1[0]['_address1'];
		$customerAccountDetail['code'] 			 = $res1[0]['code'];
		// var_dump($customerAccountDetail);die;

		//get the promo list id based on a campaign id ;
        $param3 = array();
        $param3['campaign_id'] = '29';
        $params = $this -> getparams('campaign','campaign_promos',$param3);
        // var_dump($params);die;
        $res2   = $this -> getinfo($params['url'],$params['access_data']);
        $promos = $res2['promos'];
        // var_dump($res2);die;
		return $this -> render('index',['page'=>'CustomerAccountDetail','customerAccountDetail'=>$customerAccountDetail,'promos'=>$promos]);
	}

	/*record points for one customer of one campaign*/
	public function actionRecordpoints(){
		$request = \yii::$app -> request;
		$post = $request -> post();
		$data = $post['Customer'];
		$data['campaign_id'] = 29;
		$params = $this -> getparams('transaction','record',$data);
		// var_dump($params);die;
		$res = $this -> getinfo($params['url'],$params['access_data']);
		// var_dump($res);die;
		if($res['status']=='success'){	
		    $this -> noticemsg('success','Congratulations! Records Points Successfully!');	
		}else{
			$this -> noticemsg('error','Sorry! Records Points failed!');	
		}
		$this -> redirect(Url::toRoute(['customer/index']));	
	}

	public function actionRedeempoints(){
		$request = \yii::$app -> request;
		$post = $request -> post();
		$data = $post['Customer'];
		$data['campaign_id'] = 29;
		$params = $this -> getparams('transaction','record',$data);
		// var_dump($params);die;
		$res = $this -> getinfo($params['url'],$params['access_data']);
		// var_dump($res);die;
		if($res['status']=='success'){	
		    $this -> noticemsg('success','Congratulations! Redeem Points Successfully!');	
		}else{
			$this -> noticemsg('error','Sorry! Redeem Points failed!');	
		}
		$this -> redirect(Url::toRoute(['customer/index']));	
	}

	/*get all customer list based on one campaign*/
	public function actionGetcustomerlist(){
		$request = \yii::$app -> request;
		$page    = $request -> get('p','AllCustomerList');
		$cache   = \yii::$app -> cache;
		$customerList = $cache -> get('customerList');	
		// $cache -> flush();die;
		if(empty($customerList)){
			$params  = $this -> getparams('search','');
			$res     = $this -> getinfo($params['url'],$params['access_data']);		
			$cache -> add('customerList',$res);//put the data in cache	
		}
		//pagination			
		$totalCount = count($cache -> get('customerList'));
		$pages      = new Pagination(['totalCount'=>$totalCount,'pageSize'=>'10']);
		$page_info  = array_slice($cache -> get('customerList'), $pages -> offset,$pages -> limit);
		// var_dump($page_info);
		return $this -> render('index',['page'=>$page,'page_info'=>$page_info,'pages'=>$pages]);
		// var_dump($res);die;
	}

	/*check the type of searching keyword*/
	private function checksearchkeyword($keyword){	
		$res    = array();
		$email  = preg_match('/^[a-z]([a-z0-9]*[-_]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[\.][a-z]{2,3}([\.][a-z]{2})?$/i',$keyword);
		$name   = preg_match('/^[A-Z|a-z][a-z]{1,20}$/',$keyword);
		$number = preg_match('/^\d{1,20}/', $keyword);
		if($email){
        	$res['email'] = $keyword;
		}else
		if($name){
			$res['first_name'] = $keyword;
			$res['last_name']  = $keyword;
		}else
		if($number){
			$res['phone']  = $keyword;
			$res['mobile'] = $keyword;
			$res['card_number'] = $keyword;
		}
		//if the search condition is void, we shoud avoid the server return all customers.
		if(empty($array)){
			$res['phone'] = "****";
		}
		return $res;
	}

	/*generate the arguments for function getinfo*/
	private function getparams($api_class='customer',$func,$more_param){
		$res = array();
		$res['url']    = "http://202.177.204.24/".$api_class."/".$func;
		if(empty($more_param)){
			$res['access_data'] = $this -> userinfo;
		}else{
			$res['access_data'] = array_merge($this -> userinfo,$more_param);
		}		
		return $res;
	}
	
	/*request data from xgate server by url */
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
    /*set notice message*/
    private function noticemsg($flag,$message){
    	$flash = \Yii::$app->getSession();
    	switch ($flag) {
    		case 'success':
    			$flash -> setFlash('success',$message);
    			break;

			case 'error':
    			$flash -> setFlash('error',$message);
    			break;

			case 'info':
    			$flash -> setFlash('info',$message);
    			break;
    		
    		default:
    			$flash -> setFlash('success','Congratulations!');
    			break;
    	}
    }
}



