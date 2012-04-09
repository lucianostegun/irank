<div class="inner_table">
	<table class="tablesorter hoHeader" cellspacing="0"> 
	<thead> 
		<tr> 
			<th>Nome</th> 
			<th>Clube</th> 
			<th>Data/Hora</th> 
			<th>Buyin</th> 
			<th>Blind</th> 
			<th>Stack</th> 
		</tr> 
	</thead> 
	<tbody id="eventLiveTbody"> 
		<?php
			$eventLiveIdList = array();
			foreach($rankingLiveObj->getEventLiveList() as $eventLiveObj):
				
				$eventLiveId       = $eventLiveObj->getId();
				$eventLiveIdList[] = $eventLiveId;
				
				$onclick = 'goToPage(\'eventLive\', \'edit\', \'eventLiveId\', '.$eventLiveId.', true)"';
		?>
		<tr onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')" id="eventLiveIdRow-<?php echo $eventLiveId ?>">
			<td onclick="<?php echo $onclick ?>"><?php echo $eventLiveObj->getEventName() ?></td> 
			<td onclick="<?php echo $onclick ?>"><?php echo $eventLiveObj->getClub()->toString() ?></td> 
			<td onclick="<?php echo $onclick ?>"><?php echo $eventLiveObj->getEventDateTime('d/m/Y') ?></td> 
			<td onclick="<?php echo $onclick ?>"><?php echo Util::formatFloat($eventLiveObj->getBuyin()) ?></td> 
			<td onclick="<?php echo $onclick ?>"><?php echo $eventLiveObj->getBlindTime() ?></td> 
			<td onclick="<?php echo $onclick ?>"><?php echo $eventLiveObj->getStackChips() ?></td> 
		</tr> 
		<?php
			endforeach;
			
			$recordCount = count($eventLiveIdList);
		?>
		<tr class="<?php echo ($recordCount?'hidden':'') ?>" id="eventLiveNoRecordsRow">
			<td colspan="7">Nenhum evento foi cadastro até o momento.<br/><?php echo link_to('Clique aqui', 'eventLive/new') ?> para cadastrar o primeiro evento.</td>
		</tr>
	</tbody>
	</table>
</div>