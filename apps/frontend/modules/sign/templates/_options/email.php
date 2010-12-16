<?php
	$receiveFriendEventConfirmNotify = $userSiteObj->getOptionValue('receiveFriendEventConfirmNotify');
	$receiveEventReminder0           = $userSiteObj->getOptionValue('receiveEventReminder0');
	$receiveEventReminder3           = $userSiteObj->getOptionValue('receiveEventReminder3');
	$receiveEventReminder7           = $userSiteObj->getOptionValue('receiveEventReminder7');
	$receiveEventCommentNotify       = $userSiteObj->getOptionValue('receiveEventCommentNotify');
?>

<table width="100%" cellspacing="1" cellpadding="0" style="margin-top: 5px" class="defaultForm">
	<tr>
		<td valign="top">
			<div class="row">
				<div class="text">Selecione abaixo as notificações que deseja ou não receber por e-mail</b></div>
				<br/>
				<br/>
			</div>
			<div class="rowCheckbox">
				<div class="field"><?php echo checkbox_tag('receiveFriendEventConfirmNotify', true, $receiveFriendEventConfirmNotify) ?></div>
				<div class="label"><label for="receiveFriendEventConfirmNotify">Confirmação de presença dos convidados para os eventos</label></div>
			</div>
			<div class="rowCheckbox">
				<div class="field"><?php echo checkbox_tag('receiveEventReminder0', true, $receiveEventReminder0) ?></div>
				<div class="label"><label for="receiveEventReminder0">Notificar eventos agendados para o dia</label></div>
			</div>
			<div class="rowCheckbox">
				<div class="field"><?php echo checkbox_tag('receiveEventReminder3', true, $receiveEventReminder3) ?></div>
				<div class="label"><label for="receiveEventReminder3">Notificar eventos agendados para 3 dias</label></div>
			</div>
			<div class="rowCheckbox">
				<div class="field"><?php echo checkbox_tag('receiveEventReminder7', true, $receiveEventReminder7) ?></div>
				<div class="label"><label for="receiveEventReminder7">Notificar eventos agendados para 7 dias</label></div>
			</div>
			<div class="rowCheckbox">
				<div class="field"><?php echo checkbox_tag('receiveEventCommentNotify', true, $receiveEventCommentNotify) ?></div>
				<div class="label"><label for="receiveEventCommentNotify">Notificar novo comentário nos eventos</label></div>
			</div>
		</td>
	</tr>
</table>