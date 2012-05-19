<?php
	$eventLiveId        = $eventLiveObj->getId();
	$rankingLiveObj     = $eventLiveObj->getRankingLive();
	$rankingName        = $rankingLiveObj->getRankingName();
	$rankingLiveId      = $eventLiveObj->getRankingLiveId();
	$eventShortName     = $eventLiveObj->toString();
	$clubObj            = $eventLiveObj->getClub();
	$clubTagName        = $clubObj->getTagName();
	$clubName           = $clubObj->getClubName();
	$clubId             = $eventLiveObj->getClubId();
	$addressQuarter     = $clubObj->getAddressQuarter();
	$city               = $clubObj->getCity()->getCityName();
	$state              = $clubObj->getCity()->getState()->getInitial();
	$description        = $eventLiveObj->getDescription();
	$description        = str_replace(chr(10), '<br/>', $description);
	$weekDay            = Util::getWeekDay($eventLiveObj->getEventDate('d/m/Y'));
	$publishPrize       = $eventLiveObj->getPublishPrize();
	$isPastDate         = $eventLiveObj->isPastDate();
	$isEnrollmentOpen   = $eventLiveObj->isEnrollmentOpen();
	
	$peopleId = $sf_user->getAttribute('peopleId');
	
	$pathList = array('Agenda'=>$moduleName.'/index', 
					  $clubName=>'#goToPage("'.$clubTagName.'", "", "", "")', 
					  $rankingName=>'#goToPage("rankingLive", "details", "rankingLiveId", '.$rankingLiveId.')', 
					  $eventShortName=>null);
	
	$fileNameLogo = $rankingLiveObj->getFileNameLogo();
	
	if( $fileNameLogo=='noImage.png' )
		$fileNameLogo = 'club/original/'.$clubObj->getFileNameLogo();
	else
		$fileNameLogo = 'ranking/'.$fileNameLogo;
	
	include_partial('home/component/commonBar', array('pathList'=>$pathList));
?>
<div class="eventDetailsArea" align="center">
	<table cellspacing="0" cellpadding="0" width="100%" class="eventDetails">
		<tr>
			<td rowspan="5" class="logo"><?php echo image_tag($fileNameLogo, array('width'=>90)) ?></td>
		</tr>
		<tr>
			<th valign="top"><h1><?php echo $eventLiveObj->getEventName() ?></h1></th>
			<td class="payInfo" align="center" rowspan="5">
				<div align="center">
				<table cellspacing="0" cellpadding="0">
					<tr>
						<th><?php echo image_tag('event/coins', array('title'=>'Valor do buy-in')) ?></th>
						<th><?php echo image_tag('event/timer', array('title'=>'Tempo dos blinds')) ?></th>
						<th><?php echo image_tag('event/chips', array('title'=>'Stack inicial')) ?></th>
						<th><?php echo image_tag('event/players', array('title'=>'Jogadores confirmados')) ?></th>
					</tr>
					<tr>
						<td><?php echo Util::formatFloat($eventLiveObj->getBuyin(), true) ?></td>
						<td><?php echo $eventLiveObj->getBlindTime('H:i') ?></td>
						<td><?php echo $eventLiveObj->getStackChips(true) ?></td>
						<td id="eventLive<?php echo $eventLiveId ?>ResumePlayers"><?php echo $eventLiveObj->getPlayers() ?></td>
					</tr>
					<tr>
						<td colspan="4" class="presence">
						</td>
					</tr>
				</table>
				<?php
					if( !$isPastDate && $isEnrollmentOpen ){
						
						if( $peopleId && $eventLiveObj->getPlayerStatus($peopleId, true) )
							echo button_tag('presenceConfirm'.$eventLiveId, 'PRESENÇA CONFIRMADA', array('image'=>'reload.png', 'class'=>'buttonPresenceYes', 'onclick'=>'confirmEventLivePresence('.$eventLiveId.')', 'title'=>'Clique para confirmar sua presença no evento'));
						else
							echo button_tag('presenceConfirm'.$eventLiveId, 'CONFIRMAR PRESENÇA', array('image'=>'ok.png', 'class'=>'buttonPresenceNo', 'onclick'=>'confirmEventLivePresence('.$eventLiveId.')', 'title'=>'Clique para cancelar sua confirmação de presença para o evento'));
					}elseif( !$isEnrollmentOpen ){
						
						echo 'Inscrições a partir de '.$eventLiveObj->getEnrollmentStartDate('d/m/Y');
					}
				?>
				</div>
			</th>
		</tr>
		<tr class="info">
			<td><?php echo $weekDay ?>, <?php echo $eventLiveObj->getEventDateTime('d/m/Y H:i') ?></th>
		</tr>
		<?php if( $rankingLiveId ): ?>
		<tr class="info">
			<td>
				<?php echo $eventLiveObj->getGameStyle()->getDescription() ?> | <?php echo $eventLiveObj->getGameType()->getDescription() ?>
				<?php echo ($rankingName?' | #'.link_to($rankingName, 'goToPage("rankingLive", "details", "rankingLiveId", '.$rankingLiveId.')', array('class'=>'rankingLive')):'') ?>
			</td>
		</tr>
		<?php endif; ?>
		<tr class="info">
			<td><?php echo link_to(sprintf('@%s - %s, %s-%s', $clubName, $addressQuarter, $city, $state), '#goToPage("club", "details", "clubId", '.$clubId.')') ?></th>
		</tr>
	</table>
	<div class="separator"></div>
	<table cellspacing="0" cellpadding="0" class="channel">
		<tr>
			<td id="eventLiveInfo" class="eventLiveTab first active" onclick="showEventLiveTab(this)" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')">Informações</td>
			<!--<td id="eventLiveCovering" class="eventLiveTab" onclick="loadEventLiveTab(this, <?php echo $eventLiveId ?>); showEventLiveTab(this)" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')">Cobertura</td>-->
			<?php if( !is_null($rankingLiveId) ): ?>
			<td id="eventLiveEvents" class="eventLiveTab" onclick="loadEventLiveTab(this, <?php echo $eventLiveId ?>); showEventLiveTab(this)" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')">Etapas</td>
			<?php endif; ?>
			<?php if( $isPastDate ): ?>
			<td id="eventLiveResult" class="eventLiveTab" onclick="loadEventLiveTab(this, <?php echo $eventLiveId ?>); showEventLiveTab(this)" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')">Resultado</td>
			<?php endif; ?>
			<?php if( $publishPrize ): ?>
			<td id="eventLivePrize" class="eventLiveTab" onclick="loadEventLiveTab(this, <?php echo $eventLiveId ?>); showEventLiveTab(this)" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')">Premiação</td>
			<?php endif ?>
			<td id="eventLivePhotos" class="eventLiveTab" onclick="loadEventLiveTab(this, <?php echo $eventLiveId ?>); showEventLiveTab(this)" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')">Fotos</td>
			<?php if( !is_null($rankingLiveId) ): ?>
			<td id="eventLiveClassify" class="eventLiveTab" onclick="loadEventLiveTab(this, <?php echo $eventLiveId ?>); showEventLiveTab(this)" class="last" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')">Ranking</td>
			<?php endif; ?>
		</tr>
	</table>
	<div class="separator"></div>
	
	<div id="eventLiveInfoContent" class="eventLiveTabContent active">
		<?php echo $description ?>
	</div>
	<?php if( !is_null($rankingLiveId) ): ?>
	<div id="eventLiveEventsContent" class="eventLiveTabContent">
		<?php include_partial('home/include/tabLoading', array()) ?>
	</div>
	<div id="eventLiveClassifyContent" class="eventLiveTabContent">
		<?php include_partial('home/include/tabLoading', array()) ?>
	</div>
	<?php endif; ?>
	<?php if( $isPastDate ): ?>
	<div id="eventLiveResultContent" class="eventLiveTabContent">
		<?php include_partial('home/include/tabLoading', array()) ?>
	</div>
	<?php endif; ?>
	<?php if( $publishPrize ): ?>
	<div id="eventLivePrizeContent" class="eventLiveTabContent">
		<?php include_partial('home/include/tabLoading', array()) ?>
	</div>
	<?php endif; ?>
	<div id="eventLivePhotosContent" class="eventLiveTabContent">
		<?php include_partial('home/include/tabLoading', array()) ?>
	</div>
	<br/><br/>
</div>

