<?php
$smtpHostname        = Config::getConfigByName('smtpHostname', true);
$smtpUsername        = Config::getConfigByName('smtpUsername', true);
$smtpPassword        = Config::getConfigByName('smtpPassword', true);
$emailSenderName     = Config::getConfigByName('emailSenderName', true);
$encodeEmailToUTF8   = Config::getConfigByName('encodeEmailToUTF8', true);
$decodeEmailFromUTF8 = Config::getConfigByName('decodeEmailFromUTF8', true);
?>
	<div class="formRow">
		<label>Servidor SMTP</label>
		<div class="formRight"><?php echo input_tag('smtpHostname', $smtpHostname, array('size'=>30, 'id'=>'controlPanelSmtpHostname')) ?></div>
		<div class="clear"></div>
	</div>
	<div class="formRow">
		<label>Usuário</label>
		<div class="formRight"><?php echo input_tag('smtpUsername', $smtpUsername, array('size'=>30, 'id'=>'controlPanelSmtpUsername')) ?></div>
		<div class="clear"></div>
	</div>
	<div class="formRow">
		<label>Senha</label>
		<div class="formRight"><?php echo input_tag('smtpPassword', $smtpPassword, array('size'=>20, 'id'=>'controlPanelSmtpPassword')) ?></div>
		<div class="clear"></div>
	</div>
	<div class="formRow">
		<label>Nome remetente</label>
		<div class="formRight"><?php echo input_tag('emailSenderName', $emailSenderName, array('size'=>35, 'id'=>'controlPanelEmailSenderName')) ?></div>
		<div class="clear"></div>
	</div>
	<div class="formRow">
		<label>Codificar UTF-8</label>
		<div class="formRight"><?php echo checkbox_tag('encodeEmailToUTF8', $encodeEmailToUTF8, array('id'=>'controlPanelEncodeEmailToUTF8')) ?></div>
		<div class="clear"></div>
	</div>
	<div class="formRow">
		<label>Decodificar UTF-8</label>
		<div class="formRight"><?php echo checkbox_tag('decodeEmailFromUTF8', $decodeEmailFromUTF8, array('id'=>'controlPanelDecodeEmailFromUTF8')) ?></div>
		<div class="clear"></div>
	</div>