<blockquote>
	<div id="eventLiveList">
		<?php
			$peopleId = $sf_user->getAttribute('peopleId');
			
//			$criteria = new Criteria();
//			$criteria->add( EventLiveViewPeer::EVENT_DATE, Util::getDate('-2d'), Criteria::GREATER_THAN);
//			$criteria->addAscendingOrderByColumn( EventLiveViewPeer::EVENT_DATE_TIME );
//			$eventLiveIdList = EventLiveViewPeer::search($criteria, true);
//			
//			$eventLiveObjList = EventLivePeer::retrieveByIds($eventLiveIdList);

			$criteria = new Criteria();
			$criteria->add( EventLivePeer::EVENT_DATE, Util::getDate('-2d'), Criteria::GREATER_THAN);
			$criteria->addAscendingOrderByColumn( EventLivePeer::EVENT_DATE_TIME );
			$eventLiveObjList = EventLivePeer::search($criteria);
			
			if( count($eventLiveObjList)==0 ):
		?>
		<h3>Nenhum evento encontrado!</h3>
		<?php
			endif;
			
			foreach($eventLiveObjList as $eventLiveObj):
				
				$eventLiveId         = $eventLiveObj->getId();
				$rankingLiveObj      = $eventLiveObj->getRankingLive();
				$rankingLiveId       = $rankingLiveObj->getId();
				$fileNameLogo        = $rankingLiveObj->getFileNameLogo();
				$isEnrollmentOpen    = $eventLiveObj->isEnrollmentOpen();

				$criteria = new Criteria();
				$criteria->add( EventLiveSchedulePeer::EVENT_DATE, Util::getDate('-2d'), Criteria::GREATER_THAN);
				foreach($eventLiveObj->getScheduleList($criteria) as $eventLiveScheduleObj):
					
					$eventLiveScheduleId = nvl($eventLiveScheduleObj->getId(), 0);
					$stepDay             = $eventLiveScheduleObj->getStepDay();
					$stepDay             = ($stepDay?' - Dia '.$stepDay:'');
		?>
		<div class="event">
			<a href="javascript:void(0)" onclick="goToPage('eventLive', 'details', 'id', <?php echo $eventLiveId ?>, false, event, 'eventLiveScheduleId', <?php echo $eventLiveScheduleId ?>)" title="Abrir detalhes do evento">
				<div class="logo">
					<?php echo image_tag('ranking/small/'.$fileNameLogo) ?><br/>
					+ Detalhes
				</div>
			</a>
			<div class="info">
				<div class="profile">
					<h1><?php echo Util::getWeekDay($eventLiveScheduleObj->getEventDateTime('d/m/Y')).', '.$eventLiveScheduleObj->getEventDateTime('d/m/Y H:i') ?>
					<?php if( $rankingLiveId ): ?>
					 - <?php echo $eventLiveObj->getGameStyle()->getDescription() ?> | <?php echo $eventLiveObj->getGameType()->getDescription() ?>
					<?php endif; ?>
					</h1>
					<h2><?php echo link_to($eventLiveObj->toString().$stepDay, '#goToPage("eventLive", "details", "id", '.$eventLiveId.', false, event, "eventLiveScheduleId", '.$eventLiveScheduleId.')') ?></h2>
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
							<td><?php echo $eventLiveObj->getStackChips(true) ?></td>
							<td id="eventLive<?php echo $eventLiveId ?>ResumePlayers"><?php echo $eventLiveObj->getPlayers() ?></td>
						</tr>
					</table>
					
					<?php
						if( $eventLiveObj->isPastDate() && $isEnrollmentOpen )
								echo button_tag('resultButton'.$eventLiveId, 'VER RESULTADO', array('image'=>'result.png', 'style'=>'margin-top: 37px; float: right', 'onclick'=>'goToPage("eventLive", "details", "id", '.$eventLiveId.', false, event, "eventLiveScheduleId", '.$eventLiveScheduleId.')'));
						elseif( $isEnrollmentOpen ){
							
							if( $peopleId && $eventLiveObj->getPlayerStatus($peopleId, true) )
								echo button_tag('presenceConfirm'.$eventLiveId, 'PRESENÇA CONFIRMADA', array('image'=>'reload.png', 'style'=>'margin-top: 37px; float: right', 'class'=>'confirmedButton', 'onclick'=>'confirmEventLivePresence('.$eventLiveId.')'));
							else
								echo button_tag('presenceConfirm'.$eventLiveId, 'CONFIRMAR PRESENÇA', array('image'=>'ok.png', 'style'=>'margin-top: 37px; float: right', 'onclick'=>'confirmEventLivePresence('.$eventLiveId.')'));
						}elseif( !$isEnrollmentOpen ){
							
							echo '<span class="enrollmentInfo">Inscrições a partir de '.$eventLiveObj->getEnrollmentStartDate('d/m/Y').'</span>';
						}
					?>
				</div>
			</div>
		</div>
			<?php endforeach; ?>
		<?php endforeach; ?>
	</div>
</blockquote>