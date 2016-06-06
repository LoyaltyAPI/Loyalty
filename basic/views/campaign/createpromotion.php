<?php 
use yii\helpers\Url;
use yii\bootstrap\Alert;
use app\models\Campaign;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
//alert info
if( Yii::$app->getSession()->hasFlash('promoerror') ) {
    echo Alert::widget([
        'options' => [
            'class' => 'alert-error',
        ],
        'body' => Yii::$app->getSession()->getFlash('promoerror'),
    ]);
}
?>
<div  style="width:100%;border:1px solid green;border-radius:5px;">
	<?php 
		$model=new Campaign();
		$form = ActiveForm::begin([
	  				'action' => ['campaign/dosetpromotion'],
	  				'method'=>'post',
	  				]);
		$model->promo_operation="x";
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
			<tr><td></td></tr>
			<tr class="info" >
				<td colspan="6">New Promotion</td>
			</tr>
			<tr>
				<td colspan="2"><b>Select Promotion_operation Type:</b></td>
			</tr>
			<tr>
				<td>
					<?= $form->field($model, 'promo_operation')->radioList(['x'=>'x','+'=>'+'])->label(''); ?>
				</td>
				<td><br/>Selecting"x" mutiples your Points with promo amount,"+" adds promo amount to your points earned</td>
			</tr>
			<tr>
				<td colspan="2"><b>Now Fill Promotion_amount:</b></td>
			</tr>
			<tr>
				<td>
					<?= $form->field($model, 'promo_amount')->textInput()->label(''); ?>
				</td>
				<td><br/>The value can be Multiplied or Added,based on the Promotion_operation setting.</td>
			</tr>
			<tr>
				<td colspan="2"><b>Promo_description:</b></td>
			</tr>
			<tr>
				<td>
					<?= $form->field($model, 'promo_description')->textarea(['rows'=>4,'cols'=>22])->label('') ?>
				</td>
			</tr>
			<tr>
				<td colspan="2">
				<?= $form->field($model, 'campaign_id')->hiddenInput(['value'=>$_GET['campaign_id']])->label(''); ?>
				<?= Html::submitButton('Create Promotion', ['name' =>'submit-button']); ?> or 
					<a  style="color:black;" href="<?php echo Url::toRoute(['campaign/editcampaign','campaign_id'=>$_GET['campaign_id']]); ?>"><?= Html::button('Cancel') ?></a>
				</td>
			</tr>

		</table>
	<?php ActiveForm::end(); ?>
</div>