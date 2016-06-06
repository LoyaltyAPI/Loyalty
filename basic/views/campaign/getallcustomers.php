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
			<td style="text-align:center;" colspan="10"><?php echo $arr['title']."(".$arr['date'].")"; ?></td>
		</tr>
		<tr class="success">
			<td>Name</td>
			<td>card_number</td>
			<td>customer_code</td>
			<td>phone</td>
			<td>email</td>
			<td>city</td>
			<td>country</td>
		</tr>
		<?php foreach($customers as $v){ ?>
		<tr>
			<td><?php echo $v['first_name'].$v['last_name']; ?></td>
			<td><?php echo $v['card_number']; ?></td>
			<td><?php echo $v['customer_code']; ?></td>
			<td><?php echo $v['phone']; ?></td>
			<td><?php echo $v['email']; ?></td>
			<td><?php echo $v['city']; ?></td>
			<td><?php echo $v['country']; ?></td>
		</tr>
		<?php } ?>
		<tr>
			<td colspan="10"><?= LinkPager::widget(['pagination' => $pages]); ?></td>
		</tr>
	</table>

</div>