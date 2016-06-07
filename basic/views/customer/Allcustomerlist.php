<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;
// var_dump($page_info);
 
?>	
<table class="table table-bordered">
	<tr>
		<td>ID</td>
		<td>Name</td>
		<td>Card#/Account Code</td>
		<td>Phone Number</td>
		<td>Email Address</td>
		<td>Operate</td>
	</tr>
<?php foreach($page_info as $key => $val){  ?>
	<tr>
		<td><?= $val['id'];?></td>
		<td><?= $val['first_name']."".$val['last_name'];?></td>
		<td><?= $val['card_number'];?></td>
		<td><?= $val['phone'];?></td>
		<td><?= $val['email'];?></td>
		<td>
			<a href="<?php echo Url::toRoute(['customer/getaccountdetail','card'=>$val['card_number'],'page'=>'LookupCustomer']); ?>">View Account Details</a>
		</td>
	</tr>
<?php } ?>


</table>

<?= LinkPager::widget(['pagination' => $pages]); ?>