<?php
use yii\helpers\Url;
use yii\bootstrap\Alert;
use app\models\Campaign;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
//alert info
if( Yii::$app->getSession()->hasFlash('promosuccess') ) {
    echo Alert::widget([
        'options' => [
            'class' => 'alert-error',
        ],
        'body' => Yii::$app->getSession()->getFlash('promosuccess'),
    ]);
}
?>
<div  style="width:100%;border:1px solid green;border-radius:5px;">

	<!-- update campaigninfo -->
	<?php 
		$model=new Campaign();
		$form = ActiveForm::begin([
  					'action' => ['campaign/getalltransactions'],
  					'method'=>'post',
  					]);
	?>
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
		<tr class="success">
			<td colspan="6"><?php echo $campaignInfo['name']; ?></td>
		</tr>
		<tr class="info">
			<td colspan="6" >Campaign Name</td>
		</tr>
		<tr>
			<td style="width:30%;">
				<?= $form->field($model, 'name')->textInput(['value'=>$campaignInfo['name']])->label(''); ?>	
			</td>
		</tr>
		<tr>
			<td colspan="4">Campaign ID:<?php echo $campaignInfo['id']; ?></td>
		</tr>
		<tr class="info">
			<td colspan="4">Ratio: Points-per-Doller</td>
		</tr>
		<tr>
			<td>Current Radio:<h3><?php echo $campaignInfo['points_ratio']; ?></h3> change to<br/> 
				<?= $form->field($model, 'points_ratio')->textInput()->label(''); ?>
			</td>
			<td colspan="3"><br/><br/>Points ratio must be a number.For example,if you set 5,it will mean you will get 5 points for every 1 dollars spent</td>
		</tr>
		<tr>
			<td><?= Html::submitButton('Update Campaign', ['name' =>'submit-button']); ?></td>
		</tr>
	</table>
	<?php ActiveForm::end(); ?>


	<!-- set depreciation -->
	<?php 
		$model=new Campaign();
		if($campaignInfo['depreciation_type']=="per_transaction"){
			$model->depreciation_type="per_transaction";
		}elseif($campaignInfo['depreciation_type']=="last_transaction"){
			$model->depreciation_type="last_transaction";
		}
		$form = ActiveForm::begin([
	  				'action' => ['campaign/setdepreciation'],
	  				'method'=>'post',
	  				]);
	?>		
	<table class="table" style="width:90%;margin:50px auto;">
			<tr class='success'>
				<td colspan="4">Depreciation</td>
			</tr>
			<tr>
				<td colspan="4" style="color:red;">
					<?php 
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
				</td>
			</tr>
			
			<tr>		
				<td style="width:30%;">
				depreciation_type:<br/>
				<?= $form->field($model, 'depreciation_type')->radioList(['per_transaction'=>'per_transaction','last_transaction'=>'last_transaction'])->label(''); ?>
				</td>
				<td colspan="3">
					<br/><br/>The deprecation_type detemines how the deprecation is calculated.If set to "last_transaction",depreciation will be calculated based on last transaction recorded.If it is set to "per_transaction" then the deprecation schedule starts being applied from the date that each transaction is recorded for that transaction.
					
				</td>
			</tr>
			<tr>
				<td>
					Depreciation Interval:<br/>
					<?= $form->field($model, 'depreciation_interval')->textInput(['value'=>$campaignInfo['depreciation_days']])->label(''); ?>
					<?= $form->field($model, 'campaign_id')->hiddenInput(['value'=>$_GET['campaign_id']])->label(''); ?>
				</td>
				<td>
					<br/><br/>For example, if you set 100,points earned in transaction Record will expire in 100 days.
				</td>
			</tr>
			<tr><td colspan="4"><?= Html::submitButton('Set Depreciation', ['name' =>'submit-button']); ?></td></tr>	
	</table>
	<?php ActiveForm::end(); ?>
	<table class="table" style="width:90%;margin:50px auto;">
		<tr class="info">
			<td colspan="4">Rewards Levels</td>
		</tr>
		<tr>
			<td>Points</td>
			<td>Description</td>
		</tr>
		<tr>
			<td>100</td>
			<td colspan="2">Free Drinks</td>
			<td><a href=""><input type="button" value="Edit"></a></td>
		</tr>
		<tr>
			<td>100</td>
			<td colspan="2">Free Drinks</td>
			<td><a href=""><input type="button" value="Edit"></a></td>
		</tr>
		<tr>
			<td>100</td>
			<td colspan="2">Free Drinks</td>
			<td><a href=""><input type="button" value="Edit"></a></td>
		</tr>
		<tr>
			<td colspan="4"><a href=""><input type="button" value="Add Another Rewards Level"></a></td>
		</tr>
		<tr class="info">
			<td colspan="4">Promotions</td>
		</tr>
		<tr>
			<td>ID</td>
			<td>Operations</td>
			<td>Promotion Description</td>
		</tr>
		<?php if($promos['status']=='success'){ ?>
		<?php foreach($promos['promos'] as $promo ){ ?>
		<?php foreach ($promo as $v) {?>
		<tr>
			<td><?php echo $v['id']; ?></td>
			<td><?php echo $v['operand'].$v['value']; ?></td>
			<td><?php echo $v['description']; ?></td>
			<td><a href=""><input type="button" value="Edit"></a></td>
		</tr>
		<?php } } ?>
		<?php }else{?>
		<tr><td colspan="4"><?php echo $promos['message']; ?></td></tr>
		<?php } ?>
		<tr>
			<td colspan="3"><a href="<?php echo Url::toRoute(['campaign/setpromotion','campaign_id'=>$_GET['campaign_id']]); ?>"><input type="button" value="Add Another Promotion"></a></td>
		</tr>
	</table>
</div>