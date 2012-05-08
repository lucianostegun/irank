<?php
	$smsCredit          = Config::getConfigByName('smsCredit', true);
	$smsMobileProntoKey = Config::getConfigByName('smsMobileProntoKey', true);
?>
	<div class="formRow">
		<label>Crédito de mensagens</label>
		<div class="formRight"><?php echo input_tag('smsCredit', $smsCredit, array('size'=>3, 'maxlength'=>5, 'id'=>'controlPanelSmsCredit')) ?></div>
		<div class="clear"></div>
	</div>
	<div class="formRow">
		<label>Chave de envio</label>
		<div class="formRight"><?php echo input_tag('smsMobileProntoKey', $smsMobileProntoKey, array('size'=>55, 'maxlength'=>40, 'id'=>'controlPanelSmsMobileProntoKey')) ?></div>
		<div class="clear"></div>
	</div>