	<div class="formRow">
		<label>Tempo para pendência</label>
		<div class="formRight">
			<?php echo input_tag('hoursToPending', $genericObj->getSettings('hoursToPending'), array('size'=>2, 'maxlength'=>2, 'id'=>'settingsHoursToPending')) ?>
			<div class="formNote">Tempo (em horas) para que o resultado um evento seja considerado "pendente".</div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>E-mail de teste</label>
		<div class="formRight">
			<?php echo input_tag('emailDebug', $genericObj->getSettings('emailDebug'), array('size'=>55, 'maxlength'=>150, 'id'=>'settingsEmailDebug')) ?>
			<div class="formNote">Endereço de e-mail utilizado nos envios de mensagens de teste</div>
		</div>
		<div class="clear"></div>
	</div>
