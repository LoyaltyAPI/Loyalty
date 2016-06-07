<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
	<tr class="success">
		<td colspan="3" style="font-weight: bold">
			Customer Account
		</td>
		<td align="center">
			<a href="<?=Url::toRoute(['customer/editcustomer','customer_code'=>$customerAccountDetail['code'],'p'=>'EditCustomer'])?>">Edit</a>
		</td>
	</tr>
</table>
<table class="account-balance table table-bordered" align="center">
	<tr align="center">
		<td >Current Balance</td>
	</tr>
	<tr align="center">
		<td>
			<h2 style="color: green">
				<?= $customerAccountDetail['balance_points']?> Points
			</h2>
		</td>
	</tr>
	<!-- <tr align="center">
		<td>
			<input type="button" value="Print Summary"/>
		</td>
	</tr> -->
</table>
<table class="customer-info table table-bordered" align="center">
	<tr align="center">
		<td>Card#</td>
		<td><?= $customerAccountDetail['card_number']?></td>
	</tr>
	<tr align="center">
		<td>Name</td>
		<td><?= $customerAccountDetail['name']?></td>
	</tr>
	<tr align="center">
		<td>Phone Number</td>
		<td><?= $customerAccountDetail['phone']?></td>
	</tr>
	<tr align="center">
		<td>Mobile</td>
		<td><?= $customerAccountDetail['mobile']?></td>
	</tr>
	<tr align="center">
		<td>Email Address</td>
		<td><?= $customerAccountDetail['email']?></td>
	</tr>
	<tr align="center">
		<td>Address</td>
		<td><?= $customerAccountDetail['address']?></td>
	</tr>	
</table>

<h4 align="center">New activity</h4>
<?php
// var_dump($promos);
$form = ActiveForm::begin([
 'action' =>['customer/recordpoints'],
 'method' =>'post',
 'options' => ['class' => 'form-horizontal add-record-points'],
 'fieldConfig' => [
       'template' => "{label}\n<div class=\"col-lg-8\">{input}</div>\n<div class=\"col-lg-2\">{error}</div>",  
       'labelOptions' => ['class' => 'col-lg-2 control-label'],  
  ],
]) ;
?>
<?=$form->field($model,'amount') ->textInput(['maxlength'=>20])->label('Enter Purchases Total:');?>
<?php 
     $promos_arr = array();
	 foreach ($promos as $key => $val) {	 		
	 		$promos_arr[$val['promo']['id']] = $val['promo']['description'];
	 }
	 // var_dump($promos_arr);
?>
<?=$form->field($model,'promo_id')->dropDownList($promos_arr, ['prompt'=>'Please Select a Promotion'])->label('Select a Promotion:') ?>
<?=$form->field($model,'code')->hiddenInput(['value'=>$customerAccountDetail['code']])->label('')?>
<?= Html::submitButton('Record Points', ['class'=>'btn btn-primary','id'=>'submit-button','style'=>'margin: 30px 100px 30px 490px;width:150px']);?>
<?php ActiveForm::end(); ?>


<h4 align="center">Rewards Available</h4>
<?php

$form = ActiveForm::begin([
 'action' =>['customer/redeempoints'],
 'method' =>'post',
 'options' => ['class' => 'form-horizontal add-record-points'],
 'fieldConfig' => [
       'template' => "{label}\n<div class=\"col-lg-8\">{input}</div>\n<div class=\"col-lg-2\">{error}</div>",  
       'labelOptions' => ['class' => 'col-lg-2 control-label'],  
  ],
]) ;
?>
<?=$form->field($model,'points_to_redeem') ->textInput(['maxlength'=>20])->label('Enter Purchases Total:');?>
<?=$form->field($model,'code')->hiddenInput(['value'=>$customerAccountDetail['code']])->label('')?>
<?= Html::submitButton('Deduct', ['class'=>'btn btn-primary','id'=>'submit-button','style'=>'margin: 30px 100px 30px 490px;width:150px']);?>
<?php ActiveForm::end(); ?>