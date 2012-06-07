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