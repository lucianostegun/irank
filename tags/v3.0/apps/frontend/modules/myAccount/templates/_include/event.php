<?php
	$sortField = $sf_request->getParameter('sortField', 'eventDateTime');
	$sortDesc  = $sf_request->getParameter('sortDesc', '1');
	$peopleId  = $sf_user->getAttribute('peopleId');
?>
<table border="0" cellspacing="0" cellpadding="0" class="gridTable">
	<tr class="header h1">
		<th class="first" colspan="6">Eventos (home)</th>
	</tr>
	<tr class="header">
		<th class="first"><?php echo link_to('Data/Hora'.($sortField=='eventDateTime'?image_tag('sort'.($sortDesc?'Desc':'Asc')):''), '#sortDataTable("event", "eventDateTime", '.($sortDesc?'false':'true').')') ?></th>
		<th><?php echo link_to('Evento'.($sortField=='eventName'?image_tag('sort'.($sortDesc?'Desc':'Asc')):''), '#sortDataTable("event", "eventName", '.($sortDesc?'false':'true').')') ?></th>
		<th><?php echo link_to('Local'.($sortField=='placeName'?image_tag('sort'.($sortDesc?'Desc':'Asc')):''), '#sortDataTable("event", "placeName", '.($sortDesc?'false':'true').')') ?></th>
		<th><?php echo link_to('Ranking'.($sortField=='rankingName'?image_tag('sort'.($sortDesc?'Desc':'Asc')):''), '#sortDataTable("event", "rankingName", '.($sortDesc?'false':'true').')') ?></th>
		<th><?php echo link_to('Buyin'.($sortField=='buyin'?image_tag('sort'.($sortDesc?'Desc':'Asc')):''), '#sortDataTable("event", "buyin", '.($sortDesc?'false':'true').')') ?></th>
		<th><?php echo link_to('Jog.'.($sortField=='players'?image_tag('sort'.($sortDesc?'Desc':'Asc')):''), '#sortDataTable("event", "players", '.($sortDesc?'false':'true').')') ?></th>
		<th></th>
	</tr>
	<tbody>
<?php
	$criteria = new Criteria();
	
	switch($sortField){
		case 'eventDateTime':
			$fieldName = EventPeer::EVENT_DATE_TIME;
			break;
		case 'eventName':
			$fieldName = EventPeer::EVENT_NAME;
			break;
		case 'placeName':
			$fieldName = RankingPlacePeer::PLACE_NAME;
			break;
		case 'rankingName':
			$fieldName = RankingPeer::RANKING_NAME;
			break;
		case 'buyin':
			$fieldName = EventPeer::BUYIN;
			break;
		case 'players':
			$fieldName = EventPeer::PLAYERS;
			break;		
	}
	
	$eventIdList = People::getPendingInviteList(true, 'home');
	
	$sortFunction = ($sortDesc?'addDescendingOrderByColumn':'addAscendingOrderByColumn');
	$criteria->add( EventPeer::ID, $eventIdList, Criteria::IN );
	$criteria->$sortFunction($fieldName);
	$eventObjList = EventPeer::search($criteria);
	
?>

<?php
	
	foreach($eventObjList as $eventObj):
		
		$eventId = $eventObj->getId();
		$onclick = 'goModule(\'event\', \'details\', \'id\', '.$eventId.')';
?>
	<tr onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')" class="pendingInviteRow" id="pendingInviteEventRow-<?php echo $eventId ?>">
		<td onclick="<?php echo $onclick ?>" class="textC"><?php echo $eventObj->getEventDateTime('d/m/Y H:i') ?></td>
		<td onclick="<?php echo $onclick ?>"><?php echo $eventObj->getEventName() ?></td>
		<td onclick="<?php echo $onclick ?>"><?php echo $eventObj->getRanking()->getRankingName() ?></td>
		<td onclick="<?php echo $onclick ?>"><?php echo $eventObj->getRankingPlace()->getPlaceName() ?></td>
		<td onclick="<?php echo $onclick ?>" class="textR"><?php echo $eventObj->getBuyinInfo() ?></td>
		<td onclick="<?php echo $onclick ?>" class="textC"><?php echo $eventObj->getPlayers() ?></td>
		<td class="textC" style="position: relative">
			<?php echo link_to(image_tag('icon/delete'), '#removePendingInvite("event", '.$eventId.')', array('title'=>'Remover convite da lista')) ?>
		</td>
	</tr>
<?php endforeach; ?>
	<tr class="<?php echo (count($eventObjList)==0?'':'hidden') ?>" id="pendingInviteEventRowEmpty">
		<td colspan="8" class="textL p10">
			Você não possui nenhum convite pendente!<br/>
			<?php echo link_to('Clique aqui', 'event/index') ?> para ver a agenda de eventos.
		</td>
	</tr>
</table>