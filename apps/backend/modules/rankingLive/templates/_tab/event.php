<div class="widget">
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