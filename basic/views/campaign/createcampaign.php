<?php 
use yii\helpers\Url;
use yii\bootstrap\Alert;
use yii\widgets\ActiveForm;
use app\models\Campaign;
use yii\helpers\Html;

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
		<?php
		 $model=new Campaign();
		 $model->campaign_type="points";
		 $form = ActiveForm::begin(['action' => ['campaign/docreatecampaign'],'method'=>'post',]);
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
				<td colspan="6">New Campaign</td>
			</tr>
			<tr>
				<!-- <td><input type="radio" name="campaign_type" value="points" checked=checked />&nbsp;<h4 style="display:inline-block;">Points</h4></td> -->
				<td><?= $form->field($model, 'campaign_type')->radioList(['points'=>'Points'])->label('Select Campaign Type:'); ?></td>
				<td>You customers accumulate points based on their purchases,payments,or promotion you define.Points can be redeemed based on custom reward level</td>
			</tr>
			<tr>
				<td>
					<?= $form->field($model, 'campaign_name')->textInput(['maxlength' => 30])->label('Now Choose a Campaign Name:'); ?>
				</td>
				<td><br/>You customers accumulate points based on their purchases,payments,or promotion you define.Points can be redeemed based on custom reward level</td>
			</tr>
			<tr>
				<td>
					<!-- <input type="number" name="points_ratio" value='' /> -->
					<?= $form->field($model, 'points_ratio')->textInput(['maxlength' => 20])->label('Now Fill Points Ratio:'); ?>
				</td>
				<td><br/>Points ratio must be a number.For example,if you set 5,it will mean you will get 5 points for every 1 dollars spent</td>
			</tr>
			<tr>
				<td colspan="2">
					<!-- <input type="submit" value="Create Campaign" /> or <a href="<?php //echo Url::toRoute(['index/index']); ?>" style="color:black;"><input type="button" value="Cancel" /></a> -->
					<?= Html::submitButton('Create Campaign', ['name' =>'submit-button']); ?> or 
					<a  style="color:black;" href="<?php echo Url::toRoute(['index/index']); ?>"><?= Html::button('Cancel') ?></a>
				</td>
			</tr>
		</table>
	<?php ActiveForm::end(); ?>
</div>