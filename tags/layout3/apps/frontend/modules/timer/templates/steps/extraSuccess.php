<h1>Preferências (4/4)</h1>

<div class="defaultForm">

	<?php
		echo form_remote_tag(array(
			'url'=>'timer/saveWizardExtra',
			'success'=>'handleSuccessWizard( request.responseText )',
			'failure'=>'handleFailureWizard( request.responseText )',
			), array('target'=>'_blank', 'id'=>'timerWizardForm'));
			
		echo input_hidden_tag('step', 5, array('id'=>'timerWizardStep')); // Próxima etapa a ser carregada
	?>
	
	<div class="row">
		<div class="label" id="timerWizardPlaySoundLabel">Reproduzir som</div>
		<div class="field"><?php echo checkbox_tag('playSound', true, $timerSession->playSound, array('onclick'=>'handlePlaySound(this.checked)', 'id'=>'timerWizardPlaySound')) ?></div>
	</div>
	
	<div class="row <?php echo ($timerSession->playSound?'':' hidden') ?>" id="timerWizardMinuteAlertRow">
		<div class="label" id="timerWizardMinuteAlertLabel">Alerta de 1 minuto</div>
		<div class="field"><?php echo checkbox_tag('minuteAlert', true, $timerSession->minuteAlert, array('id'=>'timerWizardMinuteAlert')) ?></div>
	</div>
	
	<div class="row">
		<div class="label" id="timerWizardcConfirmLevelLabel">Confirmar nível</div>
		<div class="field"><?php echo checkbox_tag('confirmLevel', true, $timerSession->confirmLevel, array('id'=>'timerWizardConfirmLevel')) ?></div>
		<div class="textFlex">Aguarda a confirmação do usuário antes de mudar o nível</div>
	</div>
	
	</form>

</div>