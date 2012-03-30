<?php
$smtpHostname        = Config::getConfigByName('smtpHostname', true);
$smtpUsername        = Config::getConfigByName('smtpUsername', true);
$smtpPassword        = Config::getConfigByName('smtpPassword', true);
$emailSenderName     = Config::getConfigByName('emailSenderName', true);
$encodeEmailToUTF8   = Config::getConfigByName('encodeEmailToUTF8', true);
$decodeEmailFromUTF8 = Config::getConfigByName('decodeEmailFromUTF8', true);
?>
<div class="module_content">
	<div class="defaultForm">
		<section>
			<label>Servidor SMTP</label>
			<?php echo input_tag('smtpHostname', $smtpHostname, array('size'=>30, 'id'=>'controlPanelSmtpHostname')) ?>
		</section>
		<section>
			<label>Usuário</label>
			<?php echo input_tag('smtpUsername', $smtpUsername, array('size'=>30, 'id'=>'controlPanelSmtpUsername')) ?>
		</section>
		<section>
			<label>Senha</label>
			<?php echo input_tag('smtpPassword', $smtpPassword, array('size'=>20, 'id'=>'controlPanelSmtpPassword')) ?>
		</section>
		<section>
			<label>Nome remetente</label>
			<?php echo input_tag('emailSenderName', $emailSenderName, array('size'=>35, 'id'=>'controlPanelEmailSenderName')) ?>
		</section>
		<section>
			<label>Codificar UTF-8</label>
			<?php echo checkbox_tag('encodeEmailToUTF8', $encodeEmailToUTF8, array('id'=>'controlPanelEncodeEmailToUTF8')) ?>
		</section>
		<section>
			<label>Decodificar UTF-8</label>
			<?php echo checkbox_tag('decodeEmailFromUTF8', $decodeEmailFromUTF8, array('id'=>'controlPanelDecodeEmailFromUTF8')) ?>
		</section>
	</div>
</div>