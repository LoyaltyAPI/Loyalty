<?php
use yii\helpers\Url;
// var_dump($matchedCustomerList);
 
?>	
<tr class="success">
		<td colspan="3" style="font-weight: bold">
			The following Records Matched Your Search:
		</td>
		<td align="center">
			<a href="<?=Url::toRoute(['customer/index'])?>">Cancel</a>
		</td>
	</tr>
</table>
<table class="table">
	<tr>
		<td>Name</td>
		<td>Card#/Account Code</td>
		<td>Phone Number</td>
		<td>Email Address</td>
		<td>Operate</td>
	</tr>
<?php foreach($matchedCustomerList as $key => $val){  ?>
	<tr>
		<td><?= $val['name'];?></td>
		<td><?= $val['card'];?></td>
		<td><?= $val['phone'];?></td>
		<td><?= $val['email'];?></td>
		<td>
			<a href="<?php echo Url::toRoute(['customer/getaccountdetail','card'=>$val['card'],'page'=>'LookupCustomer']); ?>">View Account Details</a>
		</td>
	</tr>
<?php } ?>

</table>






