<?php
	$sortField = $sf_request->getParameter('sortField', 'eventDateTime');
	$sortDesc  = $sf_request->getParameter('sortDesc', '1');
	$peopleId  = $sf_user->getAttribute('peopleId');
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
		<th></th>
	</tr>
	<tbody>
<?php
	$criteria = new Criteria();
	
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
	
	$eventLiveIdList = People::getPendingInvites(true);
	
	$sortFunction = ($sortDesc?'addDescendingOrderByColumn':'addAscendingOrderByColumn');
	$criteria->add( EventLivePeer::ID, $eventLiveIdList, Criteria::IN );
	$criteria->$sortFunction($fieldName);
	$eventLiveObjList = EventLivePeer::search($criteria);
	
?>

<?php
	
	foreach($eventLiveObjList as $eventLiveObj):
		
		$eventLiveId    = $eventLiveObj->getId();
		$rankingLiveObj = $eventLiveObj->getRankingLive();
		$rankingLiveId  = $rankingLiveObj->getId();
		$fileNameLogo   = $rankingLiveObj->getFileNameLogo();
		
		$onclick = 'goModule(\'eventLive\', \'details\', \'id\', '.$eventLiveId.')';
?>
	<tr onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')" class="pendingInviteRow" id="pendingInviteRow-<?php echo $eventLiveId ?>">
		<td onclick="<?php echo $onclick ?>" class="textC"><?php echo $eventLiveObj->getEventDateTime('d/m/Y H:i') ?></td>
		<td onclick="<?php echo $onclick ?>"><?php echo $eventLiveObj->toString() ?></td>
		<td onclick="<?php echo $onclick ?>"><?php echo $eventLiveObj->getClub()->getClubName() ?></td>
		<td onclick="<?php echo $onclick ?>" class="textR"><?php echo $eventLiveObj->getBuyinInfo() ?></td>
		<td onclick="<?php echo $onclick ?>" class="textC"><?php echo $eventLiveObj->getStackChips(true) ?></td>
		<td onclick="<?php echo $onclick ?>" class="textC"><?php echo $eventLiveObj->getBlindTime('H:i') ?></td>
		<td onclick="<?php echo $onclick ?>" class="textC"><?php echo $eventLiveObj->getPlayers() ?></td>
		<td class="textC" style="position: relative">
			<?php echo link_to(image_tag('icon/delete'), '#removePendingInvite('.$eventLiveId.')') ?>
			<div class="quickConfirmButton" id="quickConfirmButton-<?php echo $eventLiveId ?>">
			<?php
//				if( $peopleId && $eventLiveObj->getPlayerStatus($peopleId, true) )
//					echo button_tag('presenceConfirm'.$eventLiveId, 'PRESENÇA CONFIRMADA', array('image'=>'reload.png', 'class'=>'confirmedButton', 'onclick'=>'confirmEventLivePresence('.$eventLiveId.')'));
//				else
//					echo button_tag('presenceConfirm'.$eventLiveId, 'CONFIRMAR PRESENÇA', array('image'=>'ok.png', 'onclick'=>'confirmEventLivePresence('.$eventLiveId.')'));
			?>
			</div>
		</td>
	</tr>
<?php endforeach; ?>
	<tr class="<?php echo (count($eventLiveObjList)==0?'':'hidden') ?>" id="pendingInviteRowEmpty">
		<td colspan="8" class="textC">
			Você não possui nenhum convite pendente!<br/>
			<?php echo link_to('Clique aqui', 'eventLive/index') ?> para ver a agenda de eventos.
		</td>
	</tr>
</table>