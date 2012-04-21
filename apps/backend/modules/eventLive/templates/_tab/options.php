	<div class="formRow">
		<label>Não publicar na agenda</label>
		<div class="formRight">
			<?php echo checkbox_tag('suppressSchedule', true, $eventLiveObj->getSuppressSchedule(), array('id'=>'eventLiveSuppressSchedule')) ?>
			<div class="clear"></div>
			<div class="formNote error" id="eventLiveFormErrorSuppressSchedule"></div>
			<div class="formNote">O evento não será divulgado na agenda sincronizada dos jogadores</div>
		</div>
		<div class="clear"></div>
	</div>