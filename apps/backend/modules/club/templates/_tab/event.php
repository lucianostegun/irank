<div class="widget">
	<table cellpadding="0" cellspacing="0" width="100%" class="display dTable">
	    <thead>
			<tr>
				<th>Nome</th> 
				<th>Clube</th> 
				<th>Data/Hora</th> 
				<th>Buyin</th> 
				<th>Blind</th> 
				<th>Stack</th> 
			</tr> 
		</thead> 
		<tbody id="eventLiveTbody"> 
			<?php
				$eventLiveIdList = array();
				foreach(EventLive::getList(null, $clubId) as $eventLiveObj):
					
					$eventLiveId       = $eventLiveObj->getId();
					$eventLiveIdList[] = $eventLiveId;
					
					$onclick = 'goToPage(\'eventLive\', \'edit\', \'eventLiveId\', '.$eventLiveId.', true)"';
			?>
			<tr class="gradeA" onclick="<?php echo $onclick ?>" id="eventLiveIdRow-<?php echo $eventLiveId ?>">
				<td width="40%"><?php echo $eventLiveObj->getEventName() ?></td> 
				<td width="24%"><?php echo $eventLiveObj->getClub()->toString() ?></td> 
				<td width="13%" align="center"><?php echo $eventLiveObj->getEventDateTime('d/m/Y H:i') ?></td> 
				<td width="7%" align="center"><?php echo Util::formatFloat($eventLiveObj->getBuyin(), true) ?></td> 
				<td width="7%" align="center"><?php echo $eventLiveObj->getBlindTime() ?></td> 
				<td width="7%" align="center"><?php echo $eventLiveObj->getStackChips(true) ?></td> 
			</tr> 
			<?php endforeach; ?>
		</tbody>
	</table>
</div>