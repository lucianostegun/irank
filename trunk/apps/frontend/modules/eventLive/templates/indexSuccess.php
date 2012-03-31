<?php
	$peopleId = $sf_user->getAttribute('peopleId');
	
	include_partial('home/component/commonBar', array('pathList'=>array('Eventos ao vivo'=>$moduleName.'/index')));
?>
<div class="moduleIntro">
	Acompanhe e participe dos principais eventos presenciais do Brasil.<br/><br/>
	<?php echo link_to('Clique aqui', 'schedule/index') ?> para aprender como sincronizar a agenda de seu smartphone ou tablet<br/>
	para receber automaticamente informações de todos os eventos dos clubes próximos a você. 
</div>
<blockquote>
	<div id="eventLiveList">
		<?php
			$eventLiveObjList = EventLivePeer::search();
			
			if( count($eventLiveObjList)==0 ):
		?>
		<h3>Nenhum evento encontrado!</h3>
		<?php
			endif;
			
			foreach($eventLiveObjList as $eventLiveObj):
				
				$eventLiveId    = $eventLiveObj->getId();
				$rankingLiveObj = $eventLiveObj->getRankingLive();
				$fileNameLogo   = $rankingLiveObj->getFileNameLogo();
		?>
		<div class="event">
			<a href="javascript:void(0)" onclick="goToPage('eventLive', 'details', 'id', <?php echo $eventLiveId ?>)" title="Abrir detalhes do evento">
				<div class="logo">
					<?php echo image_tag('ranking/'.$fileNameLogo) ?><br/>
					+ Detalhes
				</div>
			</a>
			<div class="info">
				<div class="profile">
					<h1><?php echo Util::getWeekDay($eventLiveObj->getEventDateTime('d/m/Y')).', '.$eventLiveObj->getEventDateTime('d/m/Y H:i') ?> - <?php echo $eventLiveObj->getGameStyle()->getDescription() ?> | <?php echo $eventLiveObj->getGameType()->getDescription() ?></h1>
					<h2><?php echo link_to($eventLiveObj->getEventName(), '#goToPage("eventLive", "details", "id", '.$eventLiveId.')') ?></h2>
					<h3>@ <?php echo $eventLiveObj->getClub()->toString() ?> - <?php echo $eventLiveObj->getClub()->getLocation() ?></h3>
					
					<table cellspacing="0" cellpadding="0" class="presenceTable">
						<tr>
							<th><?php echo image_tag('event/coins', array('title'=>'Valor do buy-in')) ?></th>
							<th><?php echo image_tag('event/timer', array('title'=>'Tempo dos blinds')) ?></th>
							<th><?php echo image_tag('event/chips', array('title'=>'Stack inicial')) ?></th>
							<th><?php echo image_tag('event/players', array('title'=>'Jogadores confirmados')) ?></th>
						</tr>
						<tr>
							<td><?php echo Util::formatFloat($eventLiveObj->getBuyin(), true) ?></td>
							<td><?php echo $eventLiveObj->getBlindTime('H:i') ?></td>
							<td><?php echo $eventLiveObj->getStackChips() ?></td>
							<td id="eventLive<?php echo $eventLiveId ?>ResumePlayers"><?php echo $eventLiveObj->getPlayers() ?></td>
						</tr>
					</table>
					
					<?php
						if( $eventLiveObj->isPastDate() )
								echo button_tag('resultButton'.$eventLiveId, 'VER RESULTADO', array('image'=>'result.png', 'style'=>'margin-top: 37px; float: right', 'onclick'=>'goToPage("eventLive", "details", "id", '.$eventLiveId.')'));
						else{
							
							if( $peopleId && $eventLiveObj->getPlayerStatus($peopleId, true) )
								echo button_tag('confirmButton'.$eventLiveId, 'PRESENÇA CONFIRMADA', array('image'=>'reload.png', 'style'=>'margin-top: 37px; float: right', 'onclick'=>'confirmEventLivePresence('.$eventLiveId.')'));
							else
								echo button_tag('confirmButton'.$eventLiveId, 'CONFIRMAR PRESENÇA', array('image'=>'ok.png', 'style'=>'margin-top: 37px; float: right', 'onclick'=>'confirmEventLivePresence('.$eventLiveId.')'));
						}
					?>
				</div>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</blockquote>