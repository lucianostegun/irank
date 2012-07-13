<?php
	$enrollmentStartDate = $eventLiveObj->getEnrollmentStartDate('d/m/Y');
	$enrollmentStartDate = ($enrollmentStartDate=='01/01/2012'?'':$enrollmentStartDate);
?>
	<div class="formRow">
		<label>Não publicar na agenda</label>
		<div class="formRight">
			<?php echo checkbox_tag('suppressSchedule', true, $eventLiveObj->getSuppressSchedule(), array('onclick'=>'handleSuppressSchedule(this.checked)', 'id'=>'eventLiveSuppressSchedule')) ?>
			<div class="clear"></div>
			<div class="formNote error" id="eventLiveFormErrorSuppressSchedule"></div>
			<div class="formNote">O evento não será divulgado na agenda sincronizada dos jogadores</div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Publicação</label>
		<div class="formRight">
			<?php echo input_tag('scheduleStartDate', $eventLiveObj->getScheduleStartDate('d/m/Y'), array('disabled'=>$eventLiveObj->getSuppressSchedule(), 'maxlength'=>10, 'class'=>'datepicker maskDate', 'id'=>'eventLiveScheduleStartDate')) ?>
			<div class="formNote error" id="eventLiveFormErrorScheduleStartDate"></div>
			<div class="formNote">Data em que o evento irá aparecer na agenda sincronizada. <i>(Vazio para imediatamente)</i></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Inscrições</label>
		<div class="formRight">
			<?php echo input_tag('enrollmentStartDate', $enrollmentStartDate, array('maxlength'=>10, 'class'=>'datepicker maskDate', 'id'=>'eventLiveEnrollmentStartDate')) ?>
			<div class="formNote error" id="eventLiveFormErrorEnrollmentStartDate"></div>
			<div class="formNote">Data em que os jogadores poderão começar a se inscrever. <i>(Vazio para imediatamente)</i></div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Rake</label>
		<div class="formRight">
			<span class="multi"><?php echo input_tag('rakePercent', Util::formatFloat($eventLiveObj->getRakePercent(), true), array('size'=>7, 'maxlength'=>7, 'class'=>'textR', 'id'=>'eventLiveRakePercent')) ?></span>
			<span class="multi"><label class="text">%</label></span>
			<div class="clear"></div>
			<div class="formNote error" id="eventLiveFormErrorRakePercent"></div>
			<div class="formNote">Porcentagem do clube</div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Nº de mesas</label>
		<div class="formRight">
			<?php echo input_tag('tablesNumber', $eventLiveObj->getTablesNumber(), array('size'=>1, 'maxlength'=>2, 'id'=>'eventLiveTablesNumber')) ?>
			<div class="formNote error" id="eventLiveFormErrorTablesNumber"></div>
		</div>
		<div class="clear"></div>
	</div>