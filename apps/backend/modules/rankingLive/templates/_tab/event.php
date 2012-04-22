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
						<th>Clube</th>
						<th>Data/Hora</th>
						<th>Buyin</th>
						<th>Blind</th>
						<th>Stack</th>
						<th>&nbsp;</th>
				    </tr>
				</thead>
				<tbody>
					<tr id="quickAddEventLiveIdRow-1">
						<?php input_hidden_tag('eventId1', null) ?>
						<td width="40%"><?php echo input_tag('eventName1', null) ?></td> 
						<td width="24%"><?php echo input_autocomplete_tag('clubName1', 'club/autocomplete', 'selectClub') ?></td> 
						<td width="15%" class="textC"><?php echo input_date_tag('eventDateTime1', null) ?></td> 
						<td width="8%" class="textR"><?php echo input_tag('buyinInfo1', null, array('size'=>6)) ?></td> 
						<td width="8%" class="textC"><?php echo input_tag('blindTime1', null, array('size'=>6)) ?></td> 
						<td width="8%" class="textR"><?php echo input_tag('stackChips1', null, array('size'=>6)) ?></td> 
						<td width="8%" class="textR"><?php echo image_tag('backend/icons/iconRed') ?></td> 
					</tr>
				</tbody>
			</table>
		<form>
	</div>
</div>