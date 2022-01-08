<?php
	$sortField = $sf_request->getParameter('sortField', 'eventDateTime');
	$sortDesc  = $sf_request->getParameter('sortDesc', '0');
?>
<table border="0" cellspacing="0" cellpadding="0" class="gridTable">
	<tr class="header">
		<th class="first"><?php echo link_to('Data/Hora'.($sortField=='eventDateTime'?image_tag('sort'.($sortDesc?'Desc':'Asc')):''), '#sortDataTable("eventDateTime", '.($sortDesc?'false':'true').')') ?></th>
		<th><?php echo link_to('Evento'.($sortField=='eventName'?image_tag('sort'.($sortDesc?'Desc':'Asc')):''), '#sortDataTable("eventName", '.($sortDesc?'false':'true').')') ?></th>
		<th><?php echo link_to('Local'.($sortField=='clubName'?image_tag('sort'.($sortDesc?'Desc':'Asc')):''), '#sortDataTable("clubName", '.($sortDesc?'false':'true').')') ?></th>
		<th><?php echo link_to('Buyin'.($sortField=='buyin'?image_tag('sort'.($sortDesc?'Desc':'Asc')):''), '#sortDataTable("buyin", '.($sortDesc?'false':'true').')') ?></th>
		<th><?php echo link_to('Stack'.($sortField=='stackChips'?image_tag('sort'.($sortDesc?'Desc':'Asc')):''), '#sortDataTable("stackChips", '.($sortDesc?'false':'true').')') ?></th>
		<th><?php echo link_to('Blinds'.($sortField=='blindTime'?image_tag('sort'.($sortDesc?'Desc':'Asc')):''), '#sortDataTable("blindTime", '.($sortDesc?'false':'true').')') ?></th>
		<th><?php echo link_to('Jog.'.($sortField=='players'?image_tag('sort'.($sortDesc?'Desc':'Asc')):''), '#sortDataTable("players", '.($sortDesc?'false':'true').')') ?></th>
	</tr>
	<tbody>
<?php
	$criteria = new Criteria();
	$criteria->add( EventLivePeer::EVENT_DATE, Util::getDate('-2d'), Criteria::GREATER_THAN);
	
	switch($sortField){
		case 'eventDateTime':
			$fieldName = EventLivePeer::EVENT_DATE_TIME;
			break;
		case 'eventName':
			$fieldName = EventLivePeer::EVENT_NAME;
			break;
		case 'clubName':
			$fieldName = ClubPeer::CLUB_NAME;
			break;
		case 'buyin':
			$fieldName = EventLivePeer::BUYIN;
			break;
		case 'stackChips':
			$fieldName = EventLivePeer::STACK_CHIPS;
			break;
		case 'blindTime':
			$fieldName = EventLivePeer::BLIND_TIME;
			break;
		case 'players':
			$fieldName = EventLivePeer::PLAYERS;
			break;		
	}
	
	$sortFunction = ($sortDesc?'addDescendingOrderByColumn':'addAscendingOrderByColumn');
	$criteria->$sortFunction($fieldName);
	$criteria->addAscendingOrderByColumn( EventLivePeer::EVENT_DATE_TIME );
			
	$eventLiveObjList = EventLivePeer::search($criteria);
	
	if( count($eventLiveObjList)==0 ):
?>
	<tr>
		<td colspan="7">Nenhum evento encontrado na pesquisa =(</td>
	</tr>
<?php
	endif;
	
	foreach($eventLiveObjList as $eventLiveObj):
		
		$eventLiveId    = $eventLiveObj->getId();
		$rankingLiveObj = $eventLiveObj->getRankingLive();
		$rankingLiveId  = $rankingLiveObj->getId();
		$fileNameLogo   = $rankingLiveObj->getFileNameLogo();
		
		$criteria = new Criteria();
		$criteria->add( EventLiveSchedulePeer::EVENT_DATE, Util::getDate('-2d'), Criteria::GREATER_THAN);
		foreach($eventLiveObj->getScheduleList($criteria) as $eventLiveScheduleObj):
			
			$eventLiveScheduleId = nvl($eventLiveScheduleObj->getId(), 0);
			$stepDay             = $eventLiveScheduleObj->getStepDay();
			$stepDay             = ($stepDay?' - Dia '.$stepDay:'');
		
		$onclick = 'goToPage(\'eventLive\', \'details\', \'id\', '.$eventLiveId.', false, event, \'eventLiveScheduleId\', '.$eventLiveScheduleId.')';
?>
	<tr onclick="<?php echo $onclick ?>" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')" class="<?php echo $className ?>">
		<td class="textC"><?php echo $eventLiveObj->getEventDateTime('d/m/Y H:i') ?></td>
		<td><?php echo $eventLiveObj->toString().$stepDay ?></td>
		<td><?php echo $eventLiveObj->getClub()->getClubName() ?></td>
		<td class="textR"><?php echo $eventLiveObj->getBuyinInfo() ?></td>
		<td class="textC"><?php echo $eventLiveObj->getStackChips(true) ?></td>
		<td class="textC"><?php echo $eventLiveObj->getBlindTime('H:i') ?></td>
		<td class="textC"><?php echo $eventLiveObj->getPlayers() ?></td>
	</tr>
	<?php endforeach; ?>
<?php endforeach; ?>
</table>