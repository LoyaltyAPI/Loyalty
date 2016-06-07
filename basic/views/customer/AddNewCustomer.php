<?php 
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

    <tr class="success">
        <td colspan="3" style="font-weight: bold">
           
            <?php   if(empty($accountDetail)){
                        echo "Create a New Customer's Account";                       
                    }else{
                        echo "Edit this Account";
                    }
            ?>
        </td>
        <td align="center">       
            <a href="<?php \Yii::$app->request->getReferrer() ?>">Cancel</a>
        </td>
        
    </tr>
</table>
 <!-- form for adding a new customer - begin -->
<?php
// var_dump($accountDetail);
 $form = ActiveForm::begin([
     'action' =>['customer/savecustomer'],
     'method' =>'post',
     'options' => ['class' => 'form-horizontal create-customer-form'],
     'fieldConfig' => [
           'template' => "{label}\n<div class=\"col-lg-6\">{input}</div>\n<div class=\"col-lg-3\">{error}</div>",  
           'labelOptions' => ['class' => 'col-lg-2 control-label'],  
      ],
 ]) ;
?>
<?php if(empty($accountDetail)){
$model -> gender = 1;
 ?>
<?=$form->field($model,'firstname') ->textInput(['maxlength'=>20]);?>
<?=$form->field($model,'lastname')  ->textInput(['maxlength'=>20]);?>
<?=$form->field($model,'email')     ->textInput();?>
<?=$form->field($model,'mobile')    ->textInput(['maxlength'=>13]);?>
<?=$form->field($model,'phone')     ->textInput(['maxlength'=>13]);?>
<?=$form->field($model,'gender')    ->radioList(['0'=>'unknown','1'=>'male','2'=>'female']);?>
<?=$form->field($model,'address1')  ->textarea(['rows'=>3]);?>
<?=$form->field($model,'address2')  ->textarea(['rows'=>3]);?>
<?=$form->field($model,'address3')  ->textarea(['rows'=>3]);?>
<?=$form->field($model,'campaign_id') ->hiddenInput(['value'=>$campaign_id])->label('');?>
<?php }else{
$model -> gender = $accountDetail[0]['gender'];
 ?>
<?=$form->field($model,'firstname') ->textInput(['maxlength'=>20,'value'=>$accountDetail[0]['first_name']]);?>
<?=$form->field($model,'lastname')  ->textInput(['maxlength'=>20,'value'=>$accountDetail[0]['last_name']]);?>
<?=$form->field($model,'email')     ->textInput(['value'=>$accountDetail[0]['email']]);?>
<?=$form->field($model,'mobile')    ->textInput(['maxlength'=>13,'value'=>$accountDetail[0]['mobile']]);?>
<?=$form->field($model,'phone')     ->textInput(['maxlength'=>13,'value'=>$accountDetail[0]['phone']]);?>
<?=$form->field($model,'gender')    ->radioList(['0'=>'unknown','1'=>'male','2'=>'female']);?>
<?=$form->field($model,'address1')  ->textarea(['rows'=>3,'value'=>$accountDetail[0]['address1']]);?>
<?=$form->field($model,'address2')  ->textarea(['rows'=>3,'value'=>$accountDetail[0]['address2']]);?>
<?=$form->field($model,'address3')  ->textarea(['rows'=>3,'value'=>$accountDetail[0]['address3']]);?>
<?=$form->field($model,'campaign_id') ->hiddenInput(['value'=>$campaign_id])->label('');?>
<?=$form->field($model,'code')     ->hiddenInput(['value'=>$accountDetail[0]['code']])->label('');?>
<?php } ?>
<?= Html::submitButton('submit', ['class'=>'btn btn-primary','id'=>'submit-button','style'=>'margin: 30px 100px 30px 200px;width:100px']);?>
<?= Html::resetButton('reset',['class'=>'btn btn-primary','id'=>'reset-button','style'=>'margin: 30px 100px 30px 100px;width: 100px;']);?>
<?php ActiveForm::end(); ?>

<!-- form for adding a new customer - begin -->