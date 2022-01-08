<table class="tablesorter" cellspacing="0"> 
	<thead> 
		<tr> 
			<th width="16"></th> 
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
			$criteria = new Criteria();
			$criterion = $criteria->getNewCriterion( EventLivePeer::EVENT_DATE, date('Y-m-d'), Criteria::GREATER_EQUAL );
			$criterion->addOr( $criteria->getNewCriterion( EventLivePeer::SAVED_RESULT, false ) );
			$criteria->add($criterion);
			
			$eventLiveIdList = array();
			foreach(EventLive::getList($criteria, $clubId) as $eventLiveObj):
				
				$eventLiveId       = $eventLiveObj->getId();
				$eventLiveIdList[] = $eventLiveId;
				
				$onclick = 'goToPage(\'eventLive\', \'edit\', \'eventLiveId\', '.$eventLiveId.')"';
				
				$className = ($eventLiveObj->isPastDate()?'dimmed':'');
				
				$eventDateTime = $eventLiveObj->getEventDateTime(null);
				
				$icon  = 'iconGreen';
				$title = 'Evento ainda não realizado';
				
				if( $eventDateTime < time()-(86400*2.5) ){
					
					$icon  = 'iconRed';
					$title = 'Evento já realizado - Resultado pendente há mais de 2 dias';
				}elseif( $eventDateTime < time()-86400 ){
					
					$icon  = 'iconYellow';
					$title = 'Evento já realizado - Resultado pendente';
				}
		?>
		<tr class="<?php echo $className ?>" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')" id="eventLiveIdRow-<?php echo $eventLiveId ?>">
			<td onclick="<?php echo $onclick ?>"><?php echo image_tag('backend/'.$icon, array('title'=>$title)) ?></td> 
			<td onclick="<?php echo $onclick ?>"><?php echo $eventLiveObj->toString() ?></td> 
			<td onclick="<?php echo $onclick ?>"><?php echo $eventLiveObj->getRankingLive()->toString() ?></td> 
			<td onclick="<?php echo $onclick ?>"><?php echo $eventLiveObj->getClub()->toString() ?></td> 
			<td onclick="<?php echo $onclick ?>"><?php echo $eventLiveObj->getEventDateTime('d/m/Y H:i') ?></td> 
			<td onclick="<?php echo $onclick ?>"><?php echo Util::formatFloat($eventLiveObj->getBuyin(), true) ?></td> 
			<td onclick="<?php echo $onclick ?>"><?php echo $eventLiveObj->getBlindTime('H:i') ?></td> 
			<td onclick="<?php echo $onclick ?>"><?php echo number_format($eventLiveObj->getStackChips(), 0, '', '.') ?></td> 
		</tr> 
		<?php
			endforeach;
			
			$recordCount = count($eventLiveIdList);
		?>
		<tr class="<?php echo ($recordCount?'hidden':'') ?>">
			<td colspan="7">Nenhum evento foi cadastro até o momento.<br/><?php echo link_to('Clique aqui', 'eventLive/new') ?> para cadastrar o primeiro evento.</td>
		</tr>
</tbody> 
</table>