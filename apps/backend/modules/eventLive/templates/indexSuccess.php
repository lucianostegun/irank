<?php
	echo form_remote_tag(array(
		'url'=>'eventLive/delete',
		'success'=>'handleSuccessEventLiveIndex(request.responseText)',
		'failure'=>'handleFailureEventLiveIndex(request.responseText)',
		'loading'=>'showIndicator("eventLive")',
		'encoding'=>'UTF8',
	), array('id'=>'eventLiveForm'));
?>
<article class="module width_full">
	<header></header>
	<table class="tablesorter hoHeader" cellspacing="0"> 
	<thead> 
		<tr> 
			<th class="checkbox"></th> 
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
			$eventLiveIdList = array();
			foreach(EventLive::getList() as $eventLiveObj):
				
				$eventLiveId       = $eventLiveObj->getId();
				$eventLiveIdList[] = $eventLiveId;
				
				$onclick = 'goToPage(\'eventLive\', \'edit\', \'eventLiveId\', '.$eventLiveId.')"';
		?>
		<tr onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')" id="eventLiveIdRow-<?php echo $eventLiveId ?>">
			<td><?php echo checkbox_tag('eventLiveId[]', $eventLiveId) ?></td> 
			<td onclick="<?php echo $onclick ?>"><?php echo $eventLiveObj->getEventName() ?></td> 
			<td onclick="<?php echo $onclick ?>"><?php echo $eventLiveObj->getRankingLive()->toString() ?></td> 
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
			<td colspan="4">Nenhum registro disponível para edição</td>
		</tr>
	</tbody> 
	</table>
<?php include_partial('home/include/paginator', array('prefix'=>'eventLive', 'recordCount'=>$recordCount)) ?>
</article><!-- end of content manager article -->
</form>