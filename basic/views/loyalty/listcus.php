<?php
use yii\widgets\LinkPager;
use yii\web\UrlManager;
use yii\helpers\Url;
// $url = Url::toRoute(['product/view', 'id' => 42]);
// $url=Url::toRoute(['loyalty/search']);
// echo $url;
use yii\bootstrap\Alert;
// $url = Url::toRoute(['product/view', 'id' => 42]);
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
<a class="btn btn-success" href="<?php echo Url::toRoute(['loyalty/createcus']) ?>">Create New User</a>
<div id="w0" data-pjax-container="" data-pjax-push-state="" data-pjax-timeout="1000">    <div id="w1" class="grid-view"><div class="summary">Showing <b>5,541-5,554</b> of <b>5,554</b> items.</div>
<table class="table table-striped table-bordered"><thead>
<tr>
	<th>ID</th>
	<th><a href="/web/index.php?r=scratch%2Fsn%2Findex&amp;page=300&amp;sort=code" data-sort="code">card_number</a></th>
	<th><a href="/web/index.php?r=scratch%2Fsn%2Findex&amp;page=300&amp;sort=is_redeem" data-sort="is_redeem">code</a></th>
	<th><a href="/web/index.php?r=scratch%2Fsn%2Findex&amp;page=300&amp;sort=user_id" data-sort="user_id">first_name</a></th>
	<th><a href="/web/index.php?r=scratch%2Fsn%2Findex&amp;page=300&amp;sort=price_id" data-sort="price_id">last_name</a></th>
	<th><a href="/web/index.php?r=scratch%2Fsn%2Findex&amp;page=300&amp;sort=create_at" data-sort="create_at">email</a></th>
	<th><a href="/web/index.php?r=scratch%2Fsn%2Findex&amp;page=300&amp;sort=create_at" data-sort="create_at">mobile</a></th>
	<th class="action-column">&nbsp;</th></tr><tr id="w1-filters" class="filters">
	<form action="<?php echo Url::toRoute(['loyalty/searchcus']); ?>"  method='post'>
		<td>搜索：</td>
		<td>
			<input type="text" class="form-control" name="card_number" value="">
		</td>
		<td>
			<input type="text" class="form-control" name="code" value="">
		</td>
		<td>
			<input type="text" class="form-control" name="first_name" value="">
		</td>
		<td>
			<input type="text" class="form-control" name="last_name" value="">
		</td>
		<td>
			<input type="text" class="form-control" name="email" value="">
		</td>
		<td>
			<input type="text" class="form-control" name="mobile" value="">
		</td>
		<td><input type="submit" value="搜索"/></td>
	</form>
</tr>
</thead>
<tbody>
<?php
// var_dump($infos);exit;
if(!array_key_exists('status',$infos) ){
foreach($infos as $v){?>
<tr data-key="5568">
	<td><?php echo $v['id']; ?></td>
	<td><?php echo $v['card_number']; ?></td>
	<td><?php echo $v['code']; ?></td>
	<td><?php echo $v['first_name'] ?></td>
	<td><?php echo $v['last_name']; ?></td>
	<td><?php echo $v['email']; ?></td>
	<td><?php echo $v['mobile']; ?></td>
	<td>
	<a href="<?php echo Url::toRoute(['loyalty/viewcus','code'=>base64_encode($v['code'])]); ?>" title="View" aria-label="View" data-pjax="0"><span class="glyphicon glyphicon-eye-open"></span></a>
	 <a href="<?php echo Url::toRoute(['loyalty/updatecus','code'=>base64_encode($v['code'])]); ?>" title="Update" aria-label="Update" data-pjax="0"><span class="glyphicon glyphicon-pencil"></span></a>
	<a href="<?php echo Url::toRoute(['loyalty/deletecus','code'=>base64_encode($v['code'])]); ?>" title="Delete" aria-label="Delete" data-confirm="Are you sure you want to delete this item?" data-method="post" data-pjax="0"><span class="glyphicon glyphicon-trash"></span></a></td></tr>
<?php } 
  }else{?>
<tr><td colspan="8"><div class="empty"><?php echo $infos['message']; ?></div></td></tr>
<?php  
}
?>
</tbody></table>
</div></div>

<?= LinkPager::widget(['pagination' => $pages]); ?>