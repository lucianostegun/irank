<?php
	foreach($rankingLiveObj->getEventLiveList() as $eventLiveObj):
		
		$eventLiveId = $eventLiveObj->getId();
		$onclick     = 'goToPage(\'eventLive\', \'edit\', \'eventLiveId\', '.$eventLiveId.', true)"';
?>
<tr class="gradeA" onclick="<?php echo $onclick ?>" id="eventLiveIdRow-<?php echo $eventLiveId ?>">
	<td width="40%"><?php echo $eventLiveObj->toString() ?></td> 
	<td width="24%"><?php echo $eventLiveObj->getClub()->toString() ?></td> 
	<td width="15%" class="textC"><?php echo $eventLiveObj->getEventDateTime('d/m/Y H:i') ?></td> 
	<td width="8%" class="textR"><?php echo Util::formatFloat($eventLiveObj->getBuyinInfo(), true) ?></td> 
	<td width="8%" class="textC"><?php echo $eventLiveObj->getBlindTime('H:i') ?></td> 
	<td width="8%" class="textR"><?php echo $eventLiveObj->getStackChips(true) ?></td> 
</tr> 
<?php endforeach; ?>