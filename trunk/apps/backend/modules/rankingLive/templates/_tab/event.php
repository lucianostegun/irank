<?php
	$isAdmin = MyTools::getUser()->hasCredential('iRankAdmin');
?>
<div class="widget">
	<div id="quickAddEventsLinkDiv" style="float: left; position: relative; margin-top: -25px">
		<?php echo link_to('Adicionar eventos', '#showAddEventForm(true)', array('id'=>'showAddEventLink')) ?>
		<?php echo link_to('Voltar', '#showAddEventForm(false)', array('id'=>'hideAddEventLink', 'style'=>'display: none')) ?>
	</div>
	<div id="eventListDiv">
		<table cellpadding="0" cellspacing="0" width="100%" class="display dTable">
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
			<tbody>
				<?php
					$eventLiveIdList = array();
					foreach($rankingLiveObj->getEventLiveList() as $eventLiveObj):
						
						$eventLiveId       = $eventLiveObj->getId();
						$eventLiveIdList[] = $eventLiveId;
						
						$onclick = 'goToPage(\'eventLive\', \'edit\', \'eventLiveId\', '.$eventLiveId.', true)"';
				?>
				<tr class="gradeA" onclick="<?php echo $onclick ?>" id="eventLiveIdRow-<?php echo $eventLiveId ?>">
					<td width="40%"><?php echo $eventLiveObj->getEventName() ?></td> 
					<td width="24%"><?php echo $eventLiveObj->getClub()->toString() ?></td> 
					<td width="15%" class="textC"><?php echo $eventLiveObj->getEventDateTime('d/m/Y H:i') ?></td> 
					<td width="8%" class="textR"><?php echo Util::formatFloat($eventLiveObj->getBuyinInfo(), true) ?></td> 
					<td width="8%" class="textC"><?php echo $eventLiveObj->getBlindTime() ?></td> 
					<td width="8%" class="textR"><?php echo $eventLiveObj->getStackChips() ?></td> 
				</tr> 
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<div id="quickAddEventFormDiv" style="display: none">
		<form id="quickAddEventForm">
			<table cellpadding="0" cellspacing="0" width="100%" class="formTable">
				<thead>
				    <tr>
						<th>Etapa</th>
						<?php if($isAdmin):?>
							<th>Clube</th>
						<?php endif; ?>
						<th>Data/Hora</th>
						<th>&nbsp;</th>
				    </tr>
				</thead>
				<tbody>
					<?php for($i=1; $i<=10; $i++): ?>
						<tr id="quickAddEventLiveIdRow-1">
							<td width="<?php echo ($isAdmin?'40':'70') ?>%"><?php echo input_tag('eventName'.$i, null, array('style'=>'width: 100%', 'onblur'=>'validateQuickAddEvent('.$i.')')) ?></td> 
							<?php if($isAdmin):?>
								<td width="30%"><?php echo select_tag('clubId'.$i, Club::getOptionsForSelect(), array('onchange'=>'validateQuickAddEvent('.$i.')')) ?></td> 
							<?php else:?>
								<?php echo input_hidden_tag('clubId'.$i, MyTools::getAttribute('clubId')) ?>
							<?php endif;?>
							<td width="20%" class="textC"><?php echo input_tag('eventDate'.$i, null, array('maxlength'=>10, 'class'=>'datepicker maskDate', 'onblur'=>'validateQuickAddEvent('.$i.')')).input_tag('startTime'.$i, null, array('size'=>5, 'maxlength'=>5, 'onkeyup'=>'maskTime(event)', 'onblur'=>'validateQuickAddEvent('.$i.')')) ?></td> 
							<td width="10%" id="quickAddEventLiveInfo<?php echo $i ?>" class="textR"><?php echo image_tag('backend/icons/iconRed') ?></td> 
						</tr>
					<?php endfor; ?>
				</tbody>
			</table>
		<form>
	</div>
</div>