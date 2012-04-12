    <table cellpadding="0" cellspacing="0" width="100%" class="sTable">
        <thead>
            <tr>
				<td class="sortCol"><div>Column name<span></span></div></td>
				<td class="sortCol"><div>Clube<span></span></div></td>
				<td class="sortCol"><div>Data/Hora<span></span></div></td>
				<td class="sortCol"><div>Buyin<span></span></div></td>
				<td class="sortCol"><div>Blind<span></span></div></td>
				<td class="sortCol"><div>Stack<span></span></div></td>
            </tr>
        </thead>
        <tbody>
		<?php
			$eventLiveIdList = array();
			foreach($rankingLiveObj->getEventLiveList() as $eventLiveObj):
				
				$eventLiveId       = $eventLiveObj->getId();
				$eventLiveIdList[] = $eventLiveId;
				
				$onclick = 'goToPage(\'eventLive\', \'edit\', \'eventLiveId\', '.$eventLiveId.', true)"';
		?>
		<tr onmouseover="$(this).addClass('hover')" onmouseout="$(this).removeClass('hover')" id="eventLiveIdRow-<?php echo $eventLiveId ?>">
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
			<td colspan="6">Nenhum evento foi cadastro até o momento.<br/><?php echo link_to('Clique aqui', 'eventLive/new') ?> para cadastrar o primeiro evento.</td>
		</tr>
	</tbody>
</table>
