<div class="wrapper">
<div class="widget">
	<div class="title"><span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></span><h6>Eventos LIVE</h6></div>                          
	<table cellpadding="0" cellspacing="0" width="100%" class="display dTable withCheck" id="checkAll">
	    <thead>
			<tr>
				<th width="10"><?php echo image_tag('backend/icons/tableArrows') ?></th>
				<th>Nome</th> 
				<th>Ranking</th> 
				<th>Clube</th> 
				<th>Data/Hora</th> 
				<th>Buyin</th> 
				<th>Blind</th> 
				<th>Stack</th> 
			</tr> 
		</thead> 
		<tbody id="eventLiveTbody"> 
			<?php
				$clubId = $sf_user->getAttribute('clubId');
				$eventLiveIdList = array();
				foreach(EventLive::getList(null, $clubId) as $eventLiveObj):
					
					$eventLiveId       = $eventLiveObj->getId();
					$eventLiveIdList[] = $eventLiveId;
					
					$onclick = 'goToPage(\'eventLive\', \'edit\', \'eventLiveId\', '.$eventLiveId.')"';
					
					$className = ($eventLiveObj->isPastDate()?'dimmed':'');
			?>
			<tr class="gradeA <?php echo $className ?>" id="eventLiveIdRow-<?php echo $eventLiveId ?>">
				<td><?php echo checkbox_tag('eventLiveId[]', $eventLiveId) ?></td> 
				<td onclick="<?php echo $onclick ?>"><?php echo $eventLiveObj->getEventName() ?></td> 
				<td onclick="<?php echo $onclick ?>"><?php echo $eventLiveObj->getRankingLive()->toString() ?></td> 
				<td onclick="<?php echo $onclick ?>"><?php echo $eventLiveObj->getClub()->toString() ?></td> 
				<td onclick="<?php echo $onclick ?>" class="textC"><?php echo $eventLiveObj->getEventDateTime('d/m/Y H:i') ?></td> 
				<td onclick="<?php echo $onclick ?>" class="textR"><?php echo Util::formatFloat($eventLiveObj->getBuyin(), true) ?></td> 
				<td onclick="<?php echo $onclick ?>" class="textC"><?php echo $eventLiveObj->getBlindTime('H:i') ?></td> 
				<td onclick="<?php echo $onclick ?>" class="textR"><?php echo $eventLiveObj->getStackChips(true) ?></td> 
			</tr> 
			<?php endforeach; ?>
		</tbody> 
	</table>
</div>
