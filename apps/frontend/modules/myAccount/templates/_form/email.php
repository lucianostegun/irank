<?php
	$receiveFriendEventConfirmNotify = $userSiteObj->getOptionValue('receiveFriendEventConfirmNotify');
	$receiveEventReminder0           = $userSiteObj->getOptionValue('receiveEventReminder0');
	$receiveEventReminder3           = $userSiteObj->getOptionValue('receiveEventReminder3');
	$receiveEventReminder5           = $userSiteObj->getOptionValue('receiveEventReminder5');
	$receiveEventCommentNotify       = $userSiteObj->getOptionValue('receiveEventCommentNotify');
	$receiveAllResults               = $userSiteObj->getOptionValue('receiveAllResults');
?>

<table width="100%" cellspacing="1" cellpadding="0" style="margin-top: 5px">
	<tr>
		<td valign="top" style="padding: 5px 5px 5px 15px"><?php echo __('myAccount.email.intro') ?></td>
	</tr>
	<tr>
		<td valign="top" class="defaultForm">
			<div class="rowCheckbox">
				<div class="field"><?php echo checkbox_tag('receiveFriendEventConfirmNotify', true, $receiveFriendEventConfirmNotify) ?></div>
				<div class="label"><label for="receiveFriendEventConfirmNotify"><?php echo __('myAccount.email.receiveFriendEventConfirmNotify') ?></label></div>
			</div>
			<div class="rowCheckbox">
				<div class="field"><?php echo checkbox_tag('receiveEventReminder0', true, $receiveEventReminder0) ?></div>
				<div class="label"><label for="receiveEventReminder0"><?php echo __('myAccount.email.receiveEventReminder0') ?></label></div>
			</div>
			<div class="rowCheckbox">
				<div class="field"><?php echo checkbox_tag('receiveEventReminder3', true, $receiveEventReminder3) ?></div>
				<div class="label"><label for="receiveEventReminder3"><?php echo __('myAccount.email.receiveEventReminder3') ?></label></div>
			</div>
			<div class="rowCheckbox">
				<div class="field"><?php echo checkbox_tag('receiveEventReminder5', true, $receiveEventReminder5) ?></div>
				<div class="label"><label for="receiveEventReminder5"><?php echo __('myAccount.email.receiveEventReminder5') ?></label></div>
			</div>
			<div class="rowCheckbox">
				<div class="field"><?php echo checkbox_tag('receiveEventCommentNotify', true, $receiveEventCommentNotify) ?></div>
				<div class="label"><label for="receiveEventCommentNotify"><?php echo __('myAccount.email.receiveEventCommentNotify') ?></label></div>
			</div>
			<div class="rowCheckbox">
				<div class="field"><?php echo checkbox_tag('receiveAllResults', true, $receiveAllResults) ?></div>
				<div class="label"><label for="receiveAllResults"><?php echo __('myAccount.email.receiveAllResults') ?></label></div>
			</div>
			
		</td>
	</tr>
</table>