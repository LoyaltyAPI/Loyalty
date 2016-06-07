<?php
use yii\helpers\Url;
use yii\bootstrap\Alert;
use app\assets\AppAsset;
use yii\widgets\ActiveForm;
// use yii\jui\DatePicker;
use app\models\Campaign;
// use dosamigos\datepicker\DatePicker;
// use dosamigos\datepicker\DateRangePicker;
use janisto\timepicker\TimePicker;
use yii\helpers\Html;
use yii\widgets\LinkPager;
//alert info
if( Yii::$app->getSession()->hasFlash('error') ) {
    echo Alert::widget([
        'options' => [
            'class' => 'alert-error',
        ],
        'body' => Yii::$app->getSession()->getFlash('error'),
    ]);
}
if( Yii::$app->getSession()->hasFlash('success') ) {
    echo Alert::widget([
        'options' => [
            'class' => 'alert-error',
        ],
        'body' => Yii::$app->getSession()->getFlash('success'),
    ]);
}
?>

<div  style="width:100%;border:1px solid green;border-radius:5px;">
	<table class="table" style="width:90%;margin:50px auto;">
		<tr>
			<td colspan="6">Xgate Loyalty</td>
		</tr>
		<tr>
			<td colspan="6">Hello,Xgate!</td>
		</tr>
		<tr><td></td>
		</tr>
		<tr>
			<td colspan="6">Special Notice Go Here</td>
		</tr>
		<tr>
			<td></td>
		</tr>
		<tr class="info">
			<td colspan="5">Account Information</td>
			<td style="text-align:right;"><a href="" ><input type="button" value="Edit"></a></td>
		</tr>
		<tr>
			<td>Business Name:</td>
			<td colspan="2">Xgate Loyalty</td>
			<td>Account Owner</td>
			<td colspan="2">Xgate Loyalty</td>
		</tr>
		<tr>
			<td >Address:</td>
			<td colspan="2">Global Center,Chengdu</td>
			<td >Owner Contact:</td>
			<td colspan="2">loyalty@xgate.com</td>
		</tr>
		<tr>
			<td>Customers:</td>
			<td colspan="4">134</td>
			<td><a href=""><input type="button" value="Manage Customer Records"></a></td>
		</tr>
		<tr>
			<td colspan="5"></td>
			<td><a href="<?php echo Url::toRoute(['customer/getcustomerlist','p'=>'AllCustomerList']) ?>"><input type="button" value="Manage Customer Records"></a></td>
		</tr>
		<tr >
			<td colspan='6' class="success">Campaigns</td>
		</tr>
		<tr>
			<td>Campaign Name</td>
			<td>Campaign Customers</td>
			<td>Campaign Transactions</td>
			<td>Customers</td>
			<td>Campaign Status</td>
			<td>Campaign Preferences</td>
		</tr>
		<?php foreach ($campArr as $v) {?>
		<tr>
			<td><?php echo $v['name'];?></td>
			<td>40</td>
			<td>210</td>
			<td style="width:15%;"><a href="<?php echo Url::toRoute(['customer/add','p'=>'AddNewCustomer','campaign_id'=>$v['id']])?>"><input type="button" value="Add">&nbsp;<a href="<?php echo Url::toRoute(['customer/index','p'=>'LookupCustomer','campaign_id'=>$v['id']])?>"><input type="button" value="Lookup"></td>
			<td>active</td>
			<td style="text-align:center;"><a href="<?php echo Url::toRoute(['campaign/editcampaign','campaign_id'=>$v['id']]); ?>" ><input type="button" value="Edit"></a></td>
		</tr>
		<?php } ?>
		<tr>
			<td colspan="6"><?= LinkPager::widget(['pagination' => $pages]); ?></td>
		</tr>
		<tr>
			<td colspan="5"><a href="<?php echo Url::toRoute(['campaign/createcampaign']); ?>"><input type="button" value="Add New Campaigns"></td>
			<td>View On-Hold Campaigns</td>
		</tr>
		<tr class="danger">
			<td colspan="5">Campaign Reports</td>
			<td style="text-align:right;"><a href="" ><input type="button" value="Show"></a></td>
		</tr>
			<tr>
				<td colspan="2">
				     <?php 
				     $model=new Campaign();
				     
				     $form = ActiveForm::begin([
  							'action' => ['campaign/getalltransactions'],
  							'method'=>'post',
  							]); ?>
					<?= $form->field($model, 'date_start')->widget(TimePicker::className(), [
				        //'language' => 'fi',
				        'mode' => 'datetime',
				        'clientOptions'=>[
				            'dateFormat' => 'yy-mm-dd',
				            'timeFormat' => 'HH:mm:ss',
				            'showSecond' => true,
				        ]
				    ])->label('Date Start:') ?>


				    <?= $form->field($model, 'date_end')->widget(TimePicker::className(), [
				        //'language' => 'zh-cn',
				        'mode' => 'datetime',
				        'clientOptions'=>[
				            'dateFormat' => 'yy-mm-dd',
				            'timeFormat' => 'HH:mm:ss',
				            'showSecond' => true,
				        ]
				    ])->label('Date End:') ?>
					
					
				    <?php 
				    $param = array();
				    foreach($campaigns as $k => $v){ 				    			
				    			$param[$v['campaign']['id']] = $v['campaign']['name'];
				    	}
				    	// var_dump($param);die;
		    		?>
					<?php echo $form->field($model, 'selected_campaigns')->checkboxList($param)->label('Select Campaigns:'); ?>
				    <?= Html::submitButton('Run Report', ['name' =>'submit-button']); ?>
				    <?php ActiveForm::end(); ?>
				</td>
			</tr>
		<tr>
			<td></td>
		</tr>
		<tr class='info'>
			<td colspan="5" >Customers Reports</td>
			<td style="text-align:right;"><a href="" ><input type="button" value="Show"></a></td>
		</tr>
			<tr>
				<td colspan="2">
				     <?php 
				     $model=new Campaign();
				     
				     $form = ActiveForm::begin([
  							'action' => ['campaign/getallcustomers'],
  							'method'=>'post',
  							]); ?>
					<?= $form->field($model, 'date_start1')->widget(TimePicker::className(), [
				        //'language' => 'fi',
				        'mode' => 'datetime',
				        'clientOptions'=>[
				            'dateFormat' => 'yy-mm-dd',
				            'timeFormat' => 'HH:mm:ss',
				            'showSecond' => true,
				        ]
				    ])->label('Date Start:') ?>


				    <?= $form->field($model, 'date_end1')->widget(TimePicker::className(), [
				        //'language' => 'zh-cn',
				        'mode' => 'datetime',
				        'clientOptions'=>[
				            'dateFormat' => 'yy-mm-dd',
				            'timeFormat' => 'HH:mm:ss',
				            'showSecond' => true,
				        ]
				    ])->label('Date End:') ?>
					
					
				    <?php 
				    $param = array();
				    foreach($campaigns as $k => $v){ 				    			
				    			$param[$v['campaign']['id']] = $v['campaign']['name'];
				    	}
				    	// var_dump($param);die;
		    		?>
					<?php echo $form->field($model, 'selected_campaigns1')->checkboxList($param)->label('Select Campaigns:'); ?>
				    <?= Html::submitButton('Run Report', ['name' =>'submit-button']); ?>
				    <?php ActiveForm::end(); ?>
				</td>
			</tr>
	</table>	
</div>