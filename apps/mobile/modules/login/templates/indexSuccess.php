<?php
	$culture = MyTools::getCulture();
	
	echo form_remote_tag(array(
		'url'=>'login/login',
		'success'=>'handleLoginSuccess( request.responseText )',
		'failure'=>'handleLoginFailure( request.responseText )',
		'encoding'=>'UTF8',
		'loading'=>'showIndicator()'
		), array( 'id'=>'mainForm' ));
?>


<div id="errorMessage" class="text" align="center" style="display: none; font-weight: bold; color: #AA0000">
<?php echo __('login.error') ?>
</div>
<br/>

<div align="center">
	<table width="95%" cellpadding="0" cellspacing="0" border="0" class="mobileForm">
		<tr>
			<td width="0" class="topLeft"><?php echo image_tag('mobile/form/topLeft') ?></td>
			<td width="100%" class="topMiddle"></td>
			<td width="0" class="topRight"><?php echo image_tag('mobile/form/topRight') ?></td>
		</tr>
	</table>
	<table width="95%" cellpadding="0" cellspacing="0" border="0" class="mobileForm">
		<tr>
			<td colspan="3" class="formContent">
			
				<table cellpadding="0" cellspacing="0" width="100%" class="formTable">
					<tr>
						<th class="firstLine"><?php echo __('login.username') ?></th>
						<td class="firstLine"><?php echo input_tag('username', null, array('size'=>20, 'id'=>'loginUsername')) ?></td>
					</tr>
					<tr>
						<th class="lastLineBar" class=""><?php echo __('login.password') ?></th>
						<td class="lastLineBar" class=""><?php echo input_tag('password', null, array('size'=>20, 'type'=>'password', 'id'=>'loginPassword')) ?></td>
					</tr>
					<tr>
						<td class="actionBar" colspan="2" align="right"><?php echo image_tag('mobile/button/'.$culture.'/connect', array('onclick'=>'doLogin()')) ?></td>
					</tr>
				</table>
							
			</td>
		</tr>
	</table>
	<table width="95%" cellpadding="0" cellspacing="0" border="0" class="mobileForm">
		<tr>
			<td class="baseLeft" width="0" valign="bottom"><?php echo image_tag('mobile/form/baseLeftGray') ?></td>
			<td width="100%" class="baseMiddleGray"></td>
			<td class="baseRight" width="0" valign="bottom"><?php echo image_tag('mobile/form/baseRightGray') ?></td>
		</tr>
	</table>
</div>

</form>
<script>
function setFocus(){

	$('loginUsername').focus();
}

setFocus();
</script>