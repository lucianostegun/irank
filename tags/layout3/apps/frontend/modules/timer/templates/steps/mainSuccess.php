<h1>Configuração principal (1/4)</h1>

<div class="defaultForm">

	<?php
		echo form_remote_tag(array(
			'url'=>'timer/saveWizardMain',
			'success'=>'handleSuccessWizard( request.responseText )',
			'failure'=>'handleFailureWizard( request.responseText )',
			), array('id'=>'timerWizardForm'));
			
		echo input_hidden_tag('step', 2, array('id'=>'timerWizardStep')); // Próxima etapa a ser carregada
	?>
	
	<div class="row">
		<div class="label" id="timerWizardTimerNameLabel">Nome</div>
		<div class="field"><?php echo input_tag('timerName', $timerSession->timerName, array('size'=>25, 'maxlength'=>25, 'class'=>'required', 'id'=>'timerWizardTimerName')) ?></div>
		<div class="error" id="timerWizardTimerNameError" onclick="showFormErrorDetails('timerWizard', 'timerName')"></div>
	</div>

	<div class="row">
		<div class="label" id="timerWizardChipStackLabel">Stack inicial</div>
		<div class="field"><?php echo input_tag('chipStack', $timerSession->chipStack, array('size'=>4, 'maxlength'=>5, 'id'=>'timerWizardChipStack')) ?></div>
		<div class="textFlex">fichas</div>
		<div class="error" id="timerWizardChipStackError" onclick="showFormErrorDetails('timerWizard', 'chipStack')"></div>
	</div>
	
	</form>

</div>