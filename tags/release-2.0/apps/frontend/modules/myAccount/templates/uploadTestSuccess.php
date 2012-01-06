<div class="commonBar"><span><?php echo __('myAccount.title') ?></span></div>
<?php
	
	echo form_tag('myAccount/uploadPhoto', array( 'id'=>'myAccountForm', 'enctype'=>'multipart/form-data' ));
	
	echo input_hidden_tag('username', 'lstegun');
	echo input_hidden_tag('userSiteId', '1');
	echo input_hidden_tag('peopleId', '1');
	
	echo input_tag('Filedata', null, array('type'=>'file'));
	echo submit_tag('Testar');
?>
</form>