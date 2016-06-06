<?php 
use yii\widgets\LinkPager;
?>
<div  style="width:100%;border:1px solid green;border-radius:5px;">
	<table class="table" style="width:90%;margin:50px auto;">
		<tr>
			<td colspan="10">Xgate Loyalty</td>
		</tr>
		<tr>
			<td colspan="10">Hello,Xgate!</td>
		</tr>
		<tr><td></td>
		</tr>
		<tr>
			<td colspan="10">Special Notice Go Here</td>
		</tr>
		<tr>
			<td></td>
		</tr>
		<tr>
			<td style="text-align:center;" colspan="10">Campaigns Report</td>
		</tr>
		<tr class="success">
			<td>id</td>
			<td>campaign_id</td>
			<td>date</td>
			<td>redeemed</td>
			<td>name</td>
			<td>email</td>
			<td>phone</td>
			<td>monetary</td>
			<td>currency</td>
			<td>points</td>
		</tr>
		<?php foreach($transactions as $v){ ?>
		<tr>
			<td><?php echo $v['transaction_id']; ?></td>
			<td><?php echo $v['campaign_id']; ?></td>
			<td><?php echo $v['date']; ?></td>
			<td><?php echo $v['redeemed']; ?></td>
			<td><?php echo $v['first_name'].$v['last_name']; ?></td>
			<td><?php echo $v['email']; ?></td>
			<td><?php echo $v['phone']; ?></td>
			<td><?php echo $v['monetary']; ?></td>
			<td><?php echo $v['currency']; ?></td>
			<td><?php echo $v['points']; ?></td>
		</tr>
		<?php } ?>
		<tr>
			<td colspan="10"><?= LinkPager::widget(['pagination' => $pages]); ?></td>
		</tr>
	</table>

</div>
