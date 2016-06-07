 <?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
 ?>
 <!-- search bar for searching customers from one campaign - begin -->
<!-- <table class="table"> -->
	<tr class="success">
		<td colspan="3" style="font-weight: bold">
			Find a Customer's Account
		</td>
		<td align="center">
			<a href="<?php \Yii::$app->request->getReferrer() ?>">Cancel</a>
		</td>
	</tr>
</table>
  <?php 
    $form = ActiveForm::begin([
    	'action' => ['customer/lookup'],
    	'method' => 'post',
    	'options' => ['class' => 'form-horizontal look-up-customer'],
    	'fieldConfig' => [
    		'template' => "{label}\n<div class=\"col-lg-6\">{input}</div>\n<div class=\"col-lg-3\">{error}</div>",
    		'labelOptions' => ['class' => 'col-lg-2 control-label'],
    	],
   ])

 ?> 
 <?=$form->field($model,'campaign_id')->hiddenInput(['value'=>$campaign_id])->label('')?>
 <?=$form->field($model,'keyword')->textInput(['maxlength'=>30]);?>
 <?= Html::submitButton('Find',['class'=>'btn btn-default','id'=>'submit-button','style'=>'position: relative;top: -50px;left: 768px;'])?>
 <?php ActiveForm::end(); ?>

 <!-- search bar for searching customers from one campaign - end -->