<?php
use yii\helpers\Url;
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
 ?>

<div class="tbl-sn-update">

    <h1>Update Tbl Sn: 1363</h1>

    
<div class="tbl-sn-form">
<?php foreach($info as $v){?>
    <form id="w0" action="<?php echo Url::toRoute(['loyalty/doupdate']);?>" method="post">
<input type="hidden" name="_csrf" value="TWUxcEpJNFIEHVNFLxBHazdWXiYjPVkhezp6KAIBZhQjNHM2fTN3ZQ==">
    <div class="form-group field-tblsn-code">
<label class="control-label" for="tblsn-code">Code</label>
<input type="text" id="tblsn-code" class="form-control" name="code" value="<?php echo $v['code']; ?>" maxlength="20">

<div class="help-block"></div>
</div>
    <div class="form-group field-tblsn-is_redeem">
<label class="control-label" for="tblsn-is_redeem">card_number</label>
<input type="text" id="tblsn-is_redeem" class="form-control" name="card_number" value="<?php echo $v['card_number']; ?>">

<div class="help-block"></div>
</div>
    <div class="form-group field-tblsn-price_id">
<label class="control-label" for="tblsn-price_id">first_name</label>
<input type="text" id="tblsn-price_id" class="form-control" name="first_name" value="<?php echo $v['first_name']; ?>" maxlength="20">

<div class="help-block"></div>
</div>
    <div class="form-group field-tblsn-user_id">
<label class="control-label" for="tblsn-user_id">last_name</label>
<input type="text" id="tblsn-user_id" class="form-control" name="last_name" value="<?php echo $v['last_name']; ?>" maxlength="20">

<div class="help-block"></div>
</div>
    <div class="form-group field-tblsn-redeem_time">
<label class="control-label" for="tblsn-redeem_time">email</label>
<input type="text" id="tblsn-redeem_time" class="form-control" name="email" value="<?php echo $v['email']; ?>">

<div class="help-block"></div>
</div>
    <div class="form-group field-tblsn-redeem_note">
<label class="control-label" for="tblsn-redeem_note">mobile</label>
<input type="text" id="tblsn-redeem_note" class="form-control" name="mobile" value="<?php echo $v['mobile']; ?>" maxlength="256">

<div class="help-block"></div>
</div>
    <div class="form-group field-tblsn-is_deleted">
<label class="control-label" for="tblsn-is_deleted">phone</label>
<input type="text" id="tblsn-is_deleted" class="form-control" name="phone" value="<?php echo $v['phone']; ?>">

<div class="help-block"></div>
</div>
    <div class="form-group field-tblsn-create_at">
<label class="control-label" for="tblsn-create_at">gender</label>
<input type="text" id="tblsn-create_at" class="form-control" name="gender" value="<?php echo $v['gender']; ?>">

<div class="help-block"></div>
</div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Update</button>    </div>

    </form>
    <?php } ?>
</div>

</div>