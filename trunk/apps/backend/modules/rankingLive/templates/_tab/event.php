<?php
	$isAdmin = MyTools::getUser()->hasCredential('iRankAdmin');
	$clubId  = $sf_user->getAttribute('clubId');
?>
	<div id="quickAddEventsLinkDiv" style="position: absolute">
		<?php echo link_to(image_tag('backend/icons/light/add', array('class'=>'icon')).'<span>Adicionar etapas</span>', '#showAddEventForm(true)', array('class'=>'button greyishB', 'id'=>'showAddEventLink')) ?>
		<?php echo link_to('<span>Voltar</span>', '#showAddEventForm(false)', array('class'=>'button greyishB', 'style'=>'display: none', 'id'=>'hideAddEventLink')) ?>
	</div>
	<div class="mt40"></div>
<div class="widget" id="eventListDiv">
	
	<table cellpadding="0" cellspacing="0" width="100%" class="display dTableCustom" id="eventLiveTable">
		<thead>
		    <tr>
				<th><div>Etapa<span></span></div></th>
				<th><div>Clube<span></span></div></th>
				<th><div>Data/Hora<span></span></div></th>
				<th><div>Buyin<span></span></div></th>
				<th><div>Blind<span></span></div></th>
				<th><div>Stack<span></span></div></th>
		    </tr>
		</thead>
		<tbody id="rankingLiveEventLiveList">
			<?php include_partial('rankingLive/include/event', array('rankingLiveObj'=>$rankingLiveObj)) ?>
		</tbody>
	</table>
</div>
<div id="quickAddEventFormDiv" class="form" style="display: none">
	<h3>Inclusão rápida de etapas </h3>
	<hr/><br/>
	<div class="formRow">
		<span class="multi" style="width: 300px; padding-left: 20px; font-weight: bold"><label>Título</label></span>
		<span class="multi" style="width: 40px; padding-left: 20px; font-weight: bold"><label>Etapa</label></span>
		<span class="multi" style="width: 40px; padding-left: 20px; font-weight: bold"><label>Dia</label></span>
		<?php if(!$clubId || $isAdmin): ?>
		<span class="multi" style="width: 180px; padding-left: 20px; font-weight: bold"><label>Clube</label></span>
		<?php endif; ?>
		<span class="multi" style="width: 80px; padding-left: 20px; font-weight: bold"><label>Data</label></span>
		<span class="multi" style="width: 70px; padding-left: 20px; font-weight: bold"><label>Hora</label></span>
		<div class="clear"></div>
	</div>
	<?php for($i=1; $i<=12; $i++): ?>
	<div class="formRow">
		<span class="multi" style="width: 320px"><?php echo input_tag('eventName'.$i, null, array('style'=>'width: 300px', 'onblur'=>'validateQuickAddEvent('.$i.')', 'id'=>'rankingLiveQuickEventLiveEventName'.$i)) ?></span>
		<span class="multi" style="width: 60px"><?php echo input_tag('stepNumber'.$i, null, array('style'=>'width: 40px', 'onblur'=>'validateQuickAddEvent('.$i.')', 'id'=>'rankingLiveQuickEventLiveStepNumber'.$i)) ?></span>
		<span class="multi" style="width: 60px"><?php echo input_tag('stepDay'.$i, null, array('style'=>'width: 40px', 'onblur'=>'validateQuickAddEvent('.$i.')', 'id'=>'rankingLiveQuickEventLiveStepDate'.$i)) ?></span>
		<?php if(!$clubId || $isAdmin): ?>
		<span class="multi" style="width: 200px; margin-top: 1px"><?php echo select_tag('clubId'.$i, Club::getOptionsForSelect(), array('onchange'=>'validateQuickAddEvent('.$i.')', 'id'=>'rankingLiveQuickEventLiveClubId'.$i)) ?></span>
		<?php else: ?>
		<?php echo input_hidden_tag('clubId'.$i, $clubId, array('id'=>'rankingLiveQuickEventLiveClubId'.$i)) ?>
		<?php endif; ?>
		<span class="multi" style="width: 100px"><?php echo input_tag('eventDate'.$i, null, array('maxlength'=>10, 'class'=>'datepickerClean maskDate', 'onblur'=>'validateQuickAddEvent('.$i.')', 'id'=>'rankingLiveQuickEventLiveEventDate'.$i)) ?></span>
		<span class="multi" style="width: 90px"><?php echo input_tag('startTime'.$i, $rankingLiveObj->getStartTime('H:i'), array('size'=>5, 'maxlength'=>5, 'class'=>'rankingLiveQuickEventStartTime', 'onkeyup'=>'maskTime(event)', 'onblur'=>'validateQuickAddEvent('.$i.')', 'id'=>'rankingLiveQuickEventLiveStartTime'.$i)) ?></span>
		<span class="multi" style="width: 30px; margin-top: 9px" id="quickAddEventLiveInfo<?php echo $i ?>"><?php echo image_tag('backend/icons/iconRed') ?></span>
		<div class="clear"></div>
	</div>
	<?php endfor; ?>
</div>