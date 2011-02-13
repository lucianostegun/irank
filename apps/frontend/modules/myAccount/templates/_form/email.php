<?php
	$receiveFriendEventConfirmNotify = $userSiteObj->getOptionValue('receiveFriendEventConfirmNotify');
	$receiveEventReminder0           = $userSiteObj->getOptionValue('receiveEventReminder0');
	$receiveEventReminder3           = $userSiteObj->getOptionValue('receiveEventReminder3');
	$receiveEventReminder7           = $userSiteObj->getOptionValue('receiveEventReminder7');
	$receiveEventCommentNotify       = $userSiteObj->getOptionValue('receiveEventCommentNotify');
	$defaultLanguage                 = $userSiteObj->getPeople()->getDefaultLanguage();
	$quickResume                     = $userSiteObj->getOptionValue('quickResume');
?>

<table width="100%" cellspacing="1" cellpadding="0" style="margin-top: 5px">
	<tr>
		<td valign="top" style="padding: 5px 5px 5px 15px"><?php echo __('myAccount.email.intro') ?></td>
	</tr>
	<tr>
		<td valign="top" class="defaultForm">
			<div class="row">
				<div class="label"><?php echo __('myAccount.defaultLanguage') ?></div>
				<div class="field"><?php echo select_tag('defaultLanguage', options_for_select(array('en_US'=>'English', 'pt_BR'=>'Português'), $defaultLanguage)) ?></div>
			</div>
			
			<hr style="margin-bottom:0px"/>
			<br/>
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
				<div class="field"><?php echo checkbox_tag('receiveEventReminder7', true, $receiveEventReminder7) ?></div>
				<div class="label"><label for="receiveEventReminder7"><?php echo __('myAccount.email.receiveEventReminder7') ?></label></div>
			</div>
			<div class="rowCheckbox">
				<div class="field"><?php echo checkbox_tag('receiveEventCommentNotify', true, $receiveEventCommentNotify) ?></div>
				<div class="label"><label for="receiveEventCommentNotify"><?php echo __('myAccount.email.receiveEventCommentNotify') ?></label></div>
			</div>
			<br/>
			<hr/>
			
			<div class="row">
				<div class="label"><?php echo __('myAccount.quickResume') ?></div>
				<div class="field">
				<?php
					$optionList = array('balance'=>__('generalCredit.balance'),
										'profit'=>__('generalCredit.profit'),
										'score'=>__('generalCredit.score'),
										'average'=>__('generalCredit.average'),
										'paid'=>__('generalCredit.paid'));
										
					echo select_tag('quickResume', options_for_select($optionList, $quickResume));
				?>
				</div>
			</div>
			
		</td>
	</tr>
</table>