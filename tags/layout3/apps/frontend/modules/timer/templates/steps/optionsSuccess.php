<h1>Informações adicionais (2/4)</h1>

<div class="defaultForm">

	<?php
		echo form_remote_tag(array(
			'url'=>'timer/saveWizardOptions',
			'success'=>'handleSuccessWizard( request.responseText )',
			'failure'=>'handleFailureWizard( request.responseText )',
			), array('id'=>'timerWizardForm'));
			
		echo input_hidden_tag('step', 3, array('id'=>'timerWizardStep')); // Próxima etapa a ser carregada
	?>
	
	<div class="row">
		<div class="label" id="timerWizardDurationLabel">Duração padrão</div>
		<div class="field"><?php echo input_tag('duration', $timerSession->duration, array('size'=>2, 'maxlength'=>3, 'class'=>'required', 'id'=>'timerWizardDuration')) ?></div>
		<div class="textFlex">minutos</div>
		<div class="error" id="timerWizardDurationError" onclick="showFormErrorDetails('timerWizard', 'duration')"></div>
	</div>
	
	<div class="row">
		<div class="label" id="timerWizardLevelsLabel">Níveis</div>
		<div class="field"><?php echo input_tag('levels', $timerSession->levels, array('size'=>2, 'maxlength'=>2, 'class'=>'required', 'id'=>'timerWizardLevels')) ?></div>
		<div class="textFlex">Quantos níveis de blinds deseja em sua configuração</div>
		<div class="error" id="timerWizardLevelsError" onclick="showFormErrorDetails('timerWizard', 'levels')"></div>
	</div>
	
	<div class="row">
		<div class="label" id="timerWizardHasAnteLabel">Incluir ante</div>
		<div class="field"><?php echo checkbox_tag('hasAnte', true, $timerSession->hasAnte, array('id'=>'timerWizardHasAnte')) ?></div>
	</div>
	
	</form>

</div>