	<div class="formRow">
		<label>Tempo para pendência</label>
		<div class="formRight">
			<?php echo input_tag('hoursToPending', $genericObj->getSettings('hoursToPending'), array('size'=>2, 'maxlength'=>2, 'id'=>'settingsHoursToPending')) ?>
			<div class="formNote">Tempo (em horas) para que o resultado um evento seja considerado "pendente".</div>
		</div>
		<div class="clear"></div>
	</div>
