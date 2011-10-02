<?php
	$receiveFriendEventConfirmNotify = $userSiteObj->getOptionValue('receiveFriendEventConfirmNotify');
	$receiveEventReminder0           = $userSiteObj->getOptionValue('receiveEventReminder0');
	$receiveEventReminder3           = $userSiteObj->getOptionValue('receiveEventReminder3');
	$receiveEventReminder5           = $userSiteObj->getOptionValue('receiveEventReminder5');
	$receiveEventCommentNotify       = $userSiteObj->getOptionValue('receiveEventCommentNotify');
	$receiveAllResults               = $userSiteObj->getOptionValue('receiveAllResults');
	$defaultLanguage                 = $userSiteObj->getPeople()->getDefaultLanguage();
	$quickResume                     = $userSiteObj->getOptionValue('quickResume');
	$quickResumePeriod               = $userSiteObj->getOptionValue('quickResumePeriod', 'always');
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

				<div class="labelFlex" style="margin-left: 20px">Desde<!-- I18N --></div>
				<div class="field">
				<?php
					$optionList = array('always'=>'Sempre',
										'currentYear'=>'Ano corrente',
										'lastYear'=>'Últimos 12 meses',
										'currentMonth'=>'Mês corrente',
										'lastMonth'=>'Últimos 30 dias');
										
					echo select_tag('quickResumePeriod', options_for_select($optionList, $quickResumePeriod));
				?>
				</div>
			</div>
			
		</td>
	</tr>
</table>