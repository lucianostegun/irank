<?php include_partial('home/component/commonBar', array('pathList'=>array('Eventos ao vivo'=>$moduleName.'/index'))); ?>
<div class="moduleIntro">
	Acompanhe e participe dos principais eventos presenciais do Brasil.<br/>
	Você pode utilizar a pesquisa no menu ao lado para filtrar os eventos por cidade, estado, buyin ou torneios.
</div>
<blockquote>
	<div id="eventLiveList">
		<?php
			$eventLiveObjList = EventLive::getList();
			
			foreach($eventLiveObjList as $eventLiveObj):
				
				$rankingLiveObj = $eventLiveObj->getRankingLive();
				$fileNameLogo   = $rankingLiveObj->getFileNameLogo();
		?>
		<div class="event">
			<a href="javascript:void(0)" onclick="goToPage('eventLive', 'details', 'id', <?php echo $eventLiveObj->getId() ?>)" title="Abrir detalhes do evento">
				<div class="logo">
					<?php echo image_tag('ranking/'.$fileNameLogo) ?><br/>
					+ Detalhes
				</div>
			</a>
			<div class="info">
				<div class="profile">
					<h1><?php echo Util::getWeekDay($eventLiveObj->getEventDateTime('d/m/Y')).', '.$eventLiveObj->getEventDateTime('d/m/Y H:i') ?></h1>
					<h2><?php echo link_to($eventLiveObj->getEventName(), '#goToPage("eventLive", "details", "id", '.$eventLiveObj->getId().')') ?></h2>
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
							<td><?php echo $eventLiveObj->getPlayers() ?></td>
						</tr>
					</table>
					
					<?php echo button_tag('confirmButton', 'CONFIRMAR PRESENÇA', array('image'=>'ok.png', 'style'=>'margin-top: 37px; float: right')) ?>
				</div>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</blockquote>