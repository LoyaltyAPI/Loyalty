<?php
use yii\helpers\Url;

?>
<div class="tbl-users-create">

    <h1>Create Tbl Users</h1>

    
<div class="tbl-users-form">

    <form id="w0" action="<?php echo Url::toRoute(['loyalty/docreate']); ?>" method="post">
<input type="hidden" name="_csrf" value="Y2FPaUNVR3cqGS1cJgw0ThlSID8qISoEVT4EMQsdFTENMA0vdC8EQA==">
    <div class="form-group field-tblusers-name">
<label class="control-label" for="tblusers-name">card_number</label>
<input type="text" id="tblusers-name" class="form-control" name="card_number" maxlength="20">

<div class="help-block"></div>
</div>
    <div class="form-group field-tblusers-openid">
<label class="control-label" for="tblusers-openid">card_number_generate</label>
<input type="text" id="tblusers-openid" class="form-control" name="card_number_generate" maxlength="50">

<div class="help-block"></div>
</div>
    <div class="form-group field-tblusers-mobile">
<label class="control-label" for="tblusers-mobile">code</label>
<input type="text" id="tblusers-mobile" class="form-control" name="code">

<div class="help-block"></div>
</div>
    <div class="form-group field-tblusers-address">
<label class="control-label" for="tblusers-address">first_name</label>
<input type="text" id="tblusers-address" class="form-control" name="first_name" maxlength="256">

<div class="help-block"></div>
</div>
    <div class="form-group field-tblusers-header_img">
<label class="control-label" for="tblusers-header_img">last_name</label>
<input type="text" id="tblusers-header_img" class="form-control" name="last_name" maxlength="256">

<div class="help-block"></div>
</div>
    <div class="form-group field-tblusers-note">
<label class="control-label" for="tblusers-note">email</label>
<input type="text" id="tblusers-note" class="form-control" name="email" maxlength="256">

<div class="help-block"></div>
</div>
    <div class="form-group field-tblusers-gender">
<label class="control-label" for="tblusers-gender">mobile</label>
<input type="text" id="tblusers-gender" class="form-control" name="mobile" maxlength="128">

<div class="help-block"></div>
</div>
    <div class="form-group field-tblusers-share_credit">
<label class="control-label" for="tblusers-share_credit">phone</label>
<input type="text" id="tblusers-share_credit" class="form-control" name="phone">

<div class="help-block"></div>
</div>
    <div class="form-group field-tblusers-contact_id">
<label class="control-label" for="tblusers-contact_id">gender</label>
<input type="text" id="tblusers-contact_id" class="form-control" name="gender" maxlength="50">

<div class="help-block"></div>
</div>
    <div class="form-group field-tblusers-tenant_id">
<label class="control-label" for="tblusers-tenant_id">Address1</label>
<input type="text" id="tblusers-tenant_id" class="form-control" name="Address1" maxlength="50">

<div class="help-block"></div>
</div>

    <div class="form-group field-tblusers-tenant_id">
<label class="control-label" for="tblusers-tenant_id">Address2</label>
<input type="text" id="tblusers-tenant_id" class="form-control" name="Address2" maxlength="50">

<div class="help-block"></div>
</div>

    <div class="form-group field-tblusers-tenant_id">
<label class="control-label" for="tblusers-tenant_id">Address3</label>
<input type="text" id="tblusers-tenant_id" class="form-control" name="Address3" maxlength="50">

<div class="help-block"></div>
</div>

    <div class="form-group field-tblusers-tenant_id">
<label class="control-label" for="tblusers-tenant_id">country</label>
<input type="text" id="tblusers-tenant_id" class="form-control" name="country" maxlength="50">

<div class="help-block"></div>
</div>

    <div class="form-group field-tblusers-tenant_id">
<label class="control-label" for="tblusers-tenant_id">campaign_id</label>
<input type="text" id="tblusers-tenant_id" class="form-control" name="campaign_id" maxlength="50">

<div class="help-block"></div>
</div>

    <div class="form-group">
        <button type="submit" class="btn btn-success">Create</button>    </div>

    </form>
</div>


</div>