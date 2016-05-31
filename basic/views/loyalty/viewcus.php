<div class="tbl-sn-view">

    <h1>1363</h1>

    <p>
        <a class="btn btn-primary" href="/web/index.php?r=scratch%2Fsn%2Fupdate&amp;id=1363">Update</a>        <a class="btn btn-danger" href="/web/index.php?r=scratch%2Fsn%2Fdelete&amp;id=1363" data-confirm="Are you sure you want to delete this item?" data-method="post">Delete</a>    </p>

    <table id="w0" class="table table-striped table-bordered detail-view">
<tbody>
	<?php foreach($info as $v){ ?>
		<tr><th>ID</th><td><?php echo $v['id']; ?></td></tr>
		<tr><th>Code</th><td><?php echo $v['code']; ?></td></tr>
		<tr><th>card_number</th><td><?php echo $v['card_number']; ?></td></tr>
		<tr><th>first_name</th><td><?php echo $v['first_name']; ?></td></tr>
		<tr><th>last_name</th><td><?php echo $v['last_name']; ?></td></tr>
		<tr><th>email</th><td><?php echo $v['email']; ?></td></tr>
		<tr><th>mobile</th><td><?php echo $v['mobile']; ?></td></tr>
		<tr><th>phone</th><td><?php echo $v['phone']; ?></td></tr>
		<tr><th>gender</th><td><?php echo $v['gender']; ?></td></tr>
		<?php } ?>
</tbody></table>
</div>