<?php 
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \app\models\Customer;
use yii\bootstrap\Alert;

$model = new Customer();
if( Yii::$app->getSession()->hasFlash('success') ) {
	 echo Alert::widget([
					'options' => [
						'class' => 'alert-success', //这里是提示框的class
					],
					'body' => \yii::$app -> getSession() -> getFlash('success'),
				]);
}else 
if( Yii::$app->getSession()->hasFlash('error') ) {
	echo Alert::widget([
		'options' => [
			'class' => 'alert-error',
		],
		'body' => Yii::$app->getSession()->getFlash('error'),
	]);
}
?>

<div class="container" style="border:1px solid #ABC18B;border-radius:6px">
	<table class="table">
		<tr>
			<td>Xgate Demo</td>
		</tr>
		<tr>
			<td>Hello, Xgate!</td>
		</tr>
		<tr>
			<td>Special Notice Go Here!</td>
		</tr>
		<tr class="success">
			<td >Reward Program</td>
			<td><a href="<?php echo Url::toRoute(['customer/getcustomerlist','p'=>'AllCustomerList']); ?>">Customer List</a></td>
			<td><a href="<?php echo Url::toRoute(['customer/index','p'=>'LookupCustomer']); ?>">Lookup a customer</a></td>
			<td><a href="<?php echo Url::toRoute(['customer/index','p'=>'AddNewCustomer']); ?>">Add a customer</a></td>
		</tr>
	<!-- </table> -->

	     
 <?php
 // var_dump($acountDetail);
 switch ($page) {
 	case 'LookupCustomer':
 		echo $this -> render('LookupCustomer',['model'=>$model,'campaign_id'=>$campaign_id]);
 		break;

 	case 'MatchedCustomerList':
 		echo $this -> render('MatchedCustomerList',['matchedCustomerList'=>$matchedCustomerList]);
 		break;

	case 'AddNewCustomer':
	    echo $this -> render('AddNewCustomer',['model'=>$model,'campaign_id'=>$campaign_id]);
 		break;
	case 'EditCustomer';
		echo $this -> render('AddNewCustomer',['model'=>$model,'accountDetail'=>$acountDetail]);
		break;

	case 'CustomerAccountDetail':
		echo $this -> render('CustomerAccountDetail',['customerAccountDetail'=>$customerAccountDetail,'promos'=>$promos,'model'=>$model]);
 		break;

	case 'AllCustomerList':
	    echo $this -> render('AllCustomerList',['page_info'=>$page_info,'pages'=>$pages]);
	    break;
 }

 ?>

 </div>
