<?php
	$rankingLiveObj = $eventLiveObj->getRankingLive();
	$rankingName    = $rankingLiveObj->getRankingName();
	$rankingLiveId  = $eventLiveObj->getRankingLiveId();
	$eventShortName = $eventLiveObj->getEventShortName();
	$clubName       = $eventLiveObj->getClub()->getClubName();
	$clubId         = $eventLiveObj->getClubId();
	$addressQuarter = $eventLiveObj->getClub()->getAddressQuarter();
	$city           = $eventLiveObj->getClub()->getCity()->getDescription();
	$state          = $eventLiveObj->getClub()->getCity()->getState()->getInitial();
	$description    = $eventLiveObj->getDescription();
	$description    = str_replace(chr(10), '<br/>', $description);
	$weekDay        = Util::getWeekDay($eventLiveObj->getEventDate('d/m/Y'));
	
	$pathList = array('Eventos ao vivo'=>$moduleName.'/index', 
					  $clubName=>'#goToPage("club", "view", "clubId", '.$clubId.')', 
					  $rankingName=>'#goToPage("ranking", "view", "rankingLiveId", '.$rankingLiveId.')', 
					  $eventShortName=>null);
?>
<?php include_partial('home/component/commonBar', array('pathList'=>$pathList)); ?>
<div class="eventDetailsArea" align="center">
	<table cellspacing="0" cellpadding="0" width="100%" class="eventDetails">
		<tr>
			<td rowspan="5" class="logo"><?php echo image_tag($rankingLiveObj->getFileNameLogo()) ?></td>
		</tr>
		<tr>
			<th valign="top"><h1><?php echo $eventLiveObj->getEventName() ?></h1></th>
			<td class="payInfo" align="center" rowspan="5">
				<div align="center">
				<table cellspacing="0" cellpadding="0">
					<tr>
						<th><?php echo image_tag('event/coins') ?></th>
						<th><?php echo image_tag('event/timer') ?></th>
						<th><?php echo image_tag('event/chips') ?></th>
						<th><?php echo image_tag('event/players') ?></th>
					</tr>
					<tr>
						<td><?php echo Util::formatFloat($eventLiveObj->getBuyin(), true) ?></td>
						<td><?php echo $eventLiveObj->getBlindTime('H:i') ?></td>
						<td><?php echo $eventLiveObj->getStackChips() ?></td>
						<td><?php echo $eventLiveObj->getPlayers() ?></td>
					</tr>
					<tr>
						<td colspan="4" class="presence"><?php echo button_tag('confirmPresence', 'CONFIRMAR PRESENÇA') ?></td>
					</tr>
				</table>
				</div>
			</th>
		</tr>
		<tr class="info">
			<td><?php echo $weekDay ?>, <?php echo $eventLiveObj->getEventDateTime('d/m/Y H:i') ?></th>
		</tr>
		<tr class="info">
			<td><?php echo link_to(sprintf('@%s - %s, %s-%s', $clubName, $addressQuarter, $city, $state), '') ?></th>
		</tr>
	</table>
	<div class="separator"></div>
	<table cellspacing="0" cellpadding="0" class="channel">
		<tr>
			<td id="eventLiveInfo" class="eventLiveTab first active" onclick="showEventLiveTab(this)" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')">Informações</td>
			<td id="eventLiveEvents" class="eventLiveTab" onclick="showEventLiveTab(this)" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')">Etapas</td>
			<td id="eventLiveResult" class="eventLiveTab" onclick="showEventLiveTab(this)" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')">Resultado</td>
			<td id="eventLivePrize" class="eventLiveTab" onclick="showEventLiveTab(this)" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')">Premiação</td>
			<td id="eventLivePhotos" class="eventLiveTab" onclick="showEventLiveTab(this)" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')">Fotos</td>
			<td id="eventLiveRanking" class="eventLiveTab" onclick="showEventLiveTab(this)" class="last" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')">Ranking</td>
		</tr>
	</table>
	<div class="separator"></div>
	
	<div id="eventLiveInfoContent" class="eventLiveTabContent active">
		<?php echo $description ?>
	</div>
	<div id="eventLiveEventsContent" class="eventLiveTabContent">
		... eventos ...
	</div>
	<div id="eventLiveResultContent" class="eventLiveTabContent">
		... resultado ...
	</div>
	<div id="eventLivePrizeContent" class="eventLiveTabContent">
		... premiação ...
	</div>
	<div id="eventLivePhotosContent" class="eventLiveTabContent">
		... photos ...
	</div>
	<div id="eventLiveRankingContent" class="eventLiveTabContent">
		... ranking ...
	</div>
	<br/><br/>
</div>

